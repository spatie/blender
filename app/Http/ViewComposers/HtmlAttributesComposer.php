<?php

namespace App\Http\ViewComposers;

use App;
use Illuminate\Contracts\View\View;

class HtmlAttributesComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $parameters['lang'] = App::getLocale();

        $htmlAttributes = $this->convertToAttributesString($parameters);

        $view->with(compact('htmlAttributes'));
    }

    /**
     * Convert the given array to an attributes string.
     *
     * @param array $parameters
     *
     * @return string
     */
    private function convertToAttributesString($parameters)
    {
        $htmlAttributes = '';
        foreach ($parameters as $property => $value) {
            $htmlAttributes .= $property.'="'.$value.'"';
        }

        return $htmlAttributes;
    }
}
