<?php

declare(strict_types=1);

namespace Aashan\LivewirePagebuilder\Blocks\Examples;

use Aashan\LivewirePageBuilder\Blocks\Block;
use Aashan\LivewirePageBuilder\UI\Forms\Checkbox;
use Aashan\LivewirePageBuilder\UI\Forms\Image;
use Aashan\LivewirePageBuilder\UI\Forms\Input;
use Aashan\LivewirePageBuilder\UI\Forms\Repeater;
use Aashan\LivewirePageBuilder\UI\Forms\Toggle;
use Aashan\LivewirePageBuilder\UI\LayoutDefinition;
use Aashan\LivewirePageBuilder\UI\Layouts\Accordion;
use Aashan\LivewirePageBuilder\UI\Layouts\Row;
use Aashan\LivewirePageBuilder\UI\Layouts\Tab;
use Aashan\LivewirePageBuilder\UI\Layouts\Tabs;
use Illuminate\Support\Str;

class ExampleBlock extends Block
{
    public $show_announcement = false;
    public $announcement = '';
    public $show_announcement_link = false;
    public $announcement_link_text = '';
    public $announcement_url = '';

    public $heading = '';
    public $show_subheading = false;
    public $subheading = '';

    public $show_primary_button = true;
    public $primary_button_text = '';
    public $primary_button_url = '';

    public $image;

    public $show_secondary_button = false;
    public $secondary_button_text = '';
    public $secondary_button_url = '';

    public static function configure(): LayoutDefinition
    {
        $layout = LayoutDefinition::make();

        $row = Row::make();
        $row->add(
            Input::make('announcement_link_text')->label('Link Text')->model()
        );
        $row->add(
            Input::make('announcement_url')->label('URL')->model()
        );

        $announcement = Tab::make()->heading('Announcement')
            ->add(Toggle::make('show_announcement')->label('Show Announcement')->model())
            ->add(Input::make('announcement')->label('Announcement')->model())
            ->add($row);

        $content = Tab::make()->heading('Content')
            ->add(Input::make('heading')->label('Heading')->attr('wire:model', 'heading'))
            ->add(Checkbox::make('show_subheading')->label('Show Subheading')->model())
            ->add(Image::make('image')->label('Image')->model())
            ->add(Input::make('subheading')->label('Subheading')->model());

        $buttons = Tab::make()->heading('Buttons')
            ->add(Accordion::make()->heading('Primary Button')->open()
                ->add(Input::make('primary_button_text')->label('Text')->model())
                ->add(Input::make('primary_button_url')->label('URL')->model())
                ->add(Checkbox::make('show_primary_button')->label('Show Button')->model())
            )
            ->add(Accordion::make()->heading('Secondary Button')
                ->add(Input::make('secondary_button_text')->label('Text')->model())
                ->add(Input::make('secondary_button_url')->label('URL')->model())
                ->add(Checkbox::make('show_secondary_button')->label('Show Button')->model())
            );

        $repeatedFields = Tab::make()->heading('Repeated Fields')
            ->add(
                Repeater::make('repeated_fields')
                    ->label('Repeated Fields')
                    ->add(Input::make('title')->label('Title')->model())
                    ->add(Input::make('description')->label('Description')->model())
            );

        $tabs = Tabs::make()->tab('announcement', $announcement);
        $tabs->tab('content', $content);
        $tabs->tab('buttons', $buttons);
        $tabs->tab('repeated_fields', $repeatedFields);

        $layout->add($tabs);

        return $layout;
    }

    public function removeImage(): void
    {
        $this->image = null;
    }

    // ======================================================================
    // ===== The following methods are not necessary to be implemented  =====
    // ===== if your block lives inside App\Block namespace             =====
    // ======================================================================
    public static function name(): string
    {
        return sprintf('LivewirePagebuiderExample::%s', parent::name());
    }

    public static function component(): string
    {
        return 'lp-example-block';
    }

    public function render(): mixed
    {
        return view(sprintf('livewire-pagebuilder::blocks.%s', Str::kebab(parent::name())));
    }
}
