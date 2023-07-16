<?php

namespace App\Livewire;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;

class Form extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public $data = [];

    public function mount()
    {
        $this->form->fill([
            'static' => 'one',
            'staticMultiple' => ['one', 'two'],
            'preloaded' => 'one',
            'preloadedMultiple' => ['one', 'two'],
            'notpreloaded' => 'one',
            'notpreloadedMultiple' => ['one', 'two'],
        ]);
    }

    protected function getFormSchema(): array
    {
        $options = [
            'one' => 'One',
            'two' => 'Two',
            'three' => 'Three',
            'four' => 'Four',
            'five' => 'Five',
            'six' => 'Six',
            'seven' => 'Seven',
            'eight' => 'Eight',
            'nine' => 'Nine',
            'ten' => 'Ten',
        ];

        return [
            Forms\Components\Select::make('static')
                ->searchable()
                ->options($options),
            Forms\Components\Select::make('staticMultiple')
                ->options($options)
                ->multiple(),
            Forms\Components\Select::make('preloaded')
                ->searchable()
                ->options(function () use ($options) {
                    return $options;
                })
                ->getSearchResultsUsing(function (string $query) use ($options) {
                    return collect($options)->filter(function (string $label) use ($query) {
                        return str_contains(strtolower($label), strtolower($query));
                    })->toArray();
                })
                ->getOptionLabelUsing(function (string $value) use ($options) {
                    return $options[$value];
                }),
            Forms\Components\Select::make('preloadedMultiple')
                ->options(function () use ($options) {
                    return $options;
                })
                ->getSearchResultsUsing(function (string $query) use ($options) {
                    return collect($options)->filter(function (string $label) use ($query) {
                        return str_contains(strtolower($label), strtolower($query));
                    })->toArray();
                })
                ->getOptionLabelsUsing(function (array $values) use ($options) {
                    return collect($values)->mapWithKeys(function (string $value) use ($options) {
                        return [$value => $options[$value]];
                    })->toArray();
                })
                ->multiple(),
            Forms\Components\Select::make('notpreloaded')
                ->searchable()
                ->getSearchResultsUsing(function (string $query) use ($options) {
                    return collect($options)->filter(function (string $label) use ($query) {
                        return str_contains(strtolower($label), strtolower($query));
                    })->toArray();
                })
                ->getOptionLabelUsing(function (string $value) use ($options) {
                    return $options[$value];
                }),
            Forms\Components\Select::make('notpreloadedMultiple')
                ->getSearchResultsUsing(function (string $query) use ($options) {
                    return collect($options)->filter(function (string $label) use ($query) {
                        return str_contains(strtolower($label), strtolower($query));
                    })->toArray();
                })
                ->getOptionLabelsUsing(function (array $values) use ($options) {
                    return collect($values)->mapWithKeys(function (string $value) use ($options) {
                        return [$value => $options[$value]];
                    })->toArray();
                })
                ->multiple(),
        ];
    }

    public function newData()
    {
        $this->form->fill([
            'static' => 'nine',
            'staticMultiple' => ['seven', 'eight'],
            'preloaded' => 'nine',
            'preloadedMultiple' => ['seven', 'eight'],
            'notpreloaded' => 'nine',
            'notpreloadedMultiple' => ['seven', 'eight'],
        ]);
    }

    public function submit()
    {
        dd($this->form->getState());
    }

    protected function getFormStatePath(): ?string
    {
        return 'data';
    }

    public function render()
    {
        return view('livewire.form');
    }
}
