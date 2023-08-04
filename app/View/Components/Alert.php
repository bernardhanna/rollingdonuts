<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Alert extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $type;

    /**
     * The alert message.
     *
     * @var string
     */
    public $message;

    /**
     * The alert types.
     *
     * @var array
     */
    public $types = [
        'default' => 'bg-indigo-50',
        'success' => 'bg-indigo-50',
        'caution' => 'bg-indigo-50',
        'warning' => 'bg-indigo-50',
    ];

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($type = 'default', $message = null)
    {
        $this->type = $this->types[$type] ?? $this->types['default'];
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.alert');
    }
}
