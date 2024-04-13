<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class breadcrumb extends Component
{
    /**
     * Create a new component instance.
     */

    public $page_current;

    public function __construct()
    {
        dd(parse_url(URL::current(), PHP_URL_PATH));
        $path_array = explode('/', substr(parse_url(URL::current(), PHP_URL_PATH), 1));
        $page = DB::table('pages')->select(['pages.id'])
            ->join('small_groups', 'pages.small_group_id', 'small_groups.id')
            ->join('big_groups', 'small_groups.big_group_id', 'big_groups.id')
            ->where('big_groups.path', $path_array[0])
            ->where('pages.path', $path_array[1])
            ->first();

        $this->page_current = Page::find($page->id);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}
