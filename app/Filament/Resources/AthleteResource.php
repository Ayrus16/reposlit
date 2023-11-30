<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AthleteResource\Pages;
use App\Filament\Resources\AthleteResource\RelationManagers;
use App\Models\Athlete;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AthleteResource extends Resource
{
    protected static ?string $model = Athlete::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Biodata')
                ->columns([
                    'sm' => 1,
                    'xl' => 2,
                    '2xl' => 2,
                ])
                ->description('Biodata of the athlete')
                ->schema([
                    TextInput::make('recommendation_position')
                        ->disabled(),
                    TextInput::make('name')
                        ->required()
                        ->columnSpanFull(),
                    Select::make('gender')
                        ->options([
                            '1' => 'Male',
                            '2' => 'Female'
                        ]),
                    DatePicker::make('date_of_birth')
                        ->required()
                        ->before('tomorrow')
                        ->required(),
                    TextInput::make('body_weight')
                        ->numeric()
                        ->minValue(1)
                        ->required(),
                    TextInput::make('body_height')
                        ->numeric()
                        ->minValue(1)
                        ->required(),
                ]),
                Section::make('Skill')
                ->columns([
                    'sm' => 1,
                    'xl' => 2,
                    '2xl' => 2,
                ])
                ->description('Skill of the athlete')
                ->schema([
                    TextInput::make('dribling')
                        ->required()
                        ->numeric()
                        ->maxValue(100)
                        ->minValue(1),
                    TextInput::make('passing')
                        ->numeric()
                        ->maxValue(100)
                        ->minValue(1)
                        ->required(),
                    TextInput::make('shooting')
                        ->numeric()
                        ->maxValue(100)
                        ->minValue(1)
                        ->required(),
                    TextInput::make('endurance')
                        ->numeric()
                        ->maxValue(100)
                        ->minValue(1)
                        ->required(),
                ]),

                Repeater::make('athleteInjuryHistory')
                ->relationship()
                ->columns([
                    'sm' => 1,
                    'xl' => 2,
                    '2xl' => 2,
                ])
                ->schema([
                    Select::make('type')
                    ->required()
                    ->columnSpanFull()
                    ->options([
                        '1' => 'Ringan',
                        '2' => 'Sedang',
                        '3' => 'Parah',
                    ]),
                    
                    DatePicker::make('date_started')
                        ->required()
                        ->label('Mulai'),
                    DatePicker::make('date_ended')
                        ->label('Pulih')
                        ->after('date_started'),
                    RichEditor::make('description')
                        ->maxLength(255)
                        ->columnSpanFull(),
                ]),

                Repeater::make('athleteClubHistory')
                ->relationship()
                ->columns([
                    'sm' => 1,
                    'xl' => 2,
                    '2xl' => 2,
                ])
                ->schema([

                    Select::make('club_id')
                        ->relationship(name: 'club', titleAttribute: 'name')
                        ->searchable(['name'])
                        ->required()
                        ->columnSpanFull(), 
                    DatePicker::make('date_started')
                        ->required()
                        ->label('Mulai'),
                    DatePicker::make('date_ended')
                        ->label('Berakhir')
                        ->after('date_started'),
                ])


                



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire,  $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('date_of_birth'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAthletes::route('/'),
            'create' => Pages\CreateAthlete::route('/create'),
            'edit' => Pages\EditAthlete::route('/{record}/edit'),
        ];
    }    
}
