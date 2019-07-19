<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;

class TableService
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function generateColumn($columns)
    {
        $requestSort = $this->request->get('sort');
        $requestDir = $this->request->get('dir');

        $html = '';
        foreach ($columns as $column) {
            $data = array_get($column, 'data');
            $sortable = array_get($column, 'sortable', is_null($data) === false);
            $label = array_get($column, 'label', $data);
            $className = array_get($column, 'className', '');
            
            if ($sortable === true) {
                $dir = ($data === $requestSort && $requestDir === 'asc') ? 'desc' : 'asc';
                $link = $this->request->fullUrlWithQuery([
                    'sort' => $data,
                    'dir' => $dir,
                ]);
                $html .= sprintf('<th class="%s %s">', ($data === $requestSort) ? $dir : '', $className);
                $label = ($data === $requestSort) ? ($dir=='asc') ? $label.'▼' : $label.'▲'  : $label.'';
                $html .= "\n";
                $html .= sprintf('<a href="%s">%s</a>', $link, $label);
                $html .= "\n";
                $html .= '</th>';
                $html .= "\n";
            } else {
                $html .= sprintf('<th class="%s">', $className);
                $html .= $label;
                $html .= '</th>';
                $html .= "\n";
            }
        }

        return new HtmlString($html);
    }
}
