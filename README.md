## Livewire Pagebuilder 
Livewire Pagebuilder is a Laravel/Livewire package that allows you to visually create and manage pages. Each page consists of modular blocks, where each block is an independent Livewire component capable of storing data and rendering dynamically based on its definition.

### Features
- Visual page building interface powered by livewire 
- Modular blocks with independent logic and rendering
- Arbitrary data storage for each block in the database
- Extendable system for implementing custom blocks 

### Key Concepts
#### Page 
In livewire pagebuilder, a page is a laravel eloquent model. The model definition can be found in `Aashan\LivewirePageBuilder\Models\Page`.
#### Block 
Similar to a page, a block is also an eloquent model. The key thing to remember here is there are two different Block files in this project.
- `Aashan\LivewirePageBuilder\Models\Block` is the eloquent model for persistant block storage.
- `Aashan\LivewirePageBuilder\Blocks\Block` is a livewire component that acts as the base for custom blocks.

### Installation
After installing the package via composer, there is a command which you can run to set up everything.
```bash 
    php artisan livewire-pagebuilder:install
```

Once this is done, run your migrations using 
```bash 
php artisan migrate
```

At this point, you're ready to proceed.

