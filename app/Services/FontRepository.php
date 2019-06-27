<?php

namespace App\Services;

class FontRepository
{
    public function font()
    {
        return $this->getSystemFont();
    }

    public function getSystemFont($family = 'Sofia')
    {
        $font = get_option('system_font');
        switch ($font) {
            case 'open_sans':
                $family = 'Open Sans';
                echo "<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,latin-ext,greek-ext,cyrillic-ext' rel='stylesheet' type='text/css'>";
                break;
            case 'open_sans_condensed':
                $family = 'Open Sans Condensed';
                echo "<link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,greek-ext,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
                break;
            case 'roboto':
                $family = 'Roboto';
                echo "<link href='//fonts.googleapis.com/css?family=Roboto:400,300,500,700&subset=latin,greek-ext,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
                break;
            case 'roboto_condensed':
                $family = 'Roboto Condensed';
                echo "<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700&subset=latin,greek-ext,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
                break;
            case 'ubuntu':
                $family = 'Ubuntu';
                echo "<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,500,700&subset=latin,greek-ext,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
                break;
            case 'lato':
                $family = 'Lato';
                echo "<link href='//fonts.googleapis.com/css?family=Lato:100,300,400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>";
                break;
            case 'oxygen':
                $family = 'Oxygen';
                echo "<link href='//fonts.googleapis.com/css?family=Oxygen:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>";
                break;
            case 'pt_sans':
                $family = 'PT Sans';
                echo "<link href='//fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
                break;
            case 'source_sans':
                $family = 'Source Sans Pro';
                echo "<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
                break;
            case 'muli':
                $family = 'Muli';
                echo "<link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet'>";
                break;
            case 'miriam':
                $family = 'Miriam Libre';
                echo "<link href='//fonts.googleapis.com/css?family=Miriam+Libre' rel='stylesheet'>";
                break;
        }
        return $family;
    }
}
