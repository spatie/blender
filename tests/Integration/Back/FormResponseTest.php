<?php

namespace App\Test\Integration\Back;

class FormResponseTest extends BackTestCase
{
    /**
     * @test
     */
    public function it_shows_a_download_button()
    {
        $this
            ->visit(action('Back\FormResponseController@showDownloadButton'))
            ->see(trans('back-formResponses.title'));
        /* Werkt niet doordat het testframework http headers verstuurt, waardoor de exceldownload faalt */
//            ->press(trans('back-formResponses.download'));
    }
}
