<?php

namespace App\Services;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class Pdf extends Dompdf
{
    /**
     * Create a new pdf instance.
     *
     * @param  array $config
     * @return void
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * Determine id the use wants to download or view.
     *
     * @return string
     */
    public function action()
    {
        return request()->has('download') ? 'attachment' : 'inline';
    }


    /**
     * Render the PDF.
     *
     * @return string
     */
    public function generate($view,$data)
    {
        $this->loadHtml(
            View::make($view, $data)->render()
        );

        $this->render();

        return $this->output();
    }
}