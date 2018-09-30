<?php

namespace App\Prints;

class Invoice extends \FPDF {

    private $font;
    private $fontPhp;

    var $szerokosci;
    var $rozmieszczenieTekstu;
    var $sprzedawcaY;
    var $sprzedawcaEndY;
    var $wystawcaY;

    public function __construct() {
        $this->font = 'Roboto-Light';
        $this->fontPhp = 'Roboto-Light.php';
        parent::__construct();

        $this->AddFont($this->font, '', $this->fontPhp);
        //$this->AddFont('arial_ce', 'I', 'arial_ce_i.php');
        //$this->AddFont('arial_ce', 'B', 'arial_ce_b.php');
        //$this->AddFont('arial_ce', 'BI', 'arial_ce_bi.php');

        $this->SetFont($this->font, '', 10);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.1);
        $this->SetFillColor(200, 200, 200);
    }

    public function setSzerokosci($szerokosc) {
        $this->szerokosci = $szerokosc;
    }

    public function setRozmieszczenieTekstu($rozmieszczenieTekstu) {
        $this->rozmieszczenieTekstu = $rozmieszczenieTekstu;
    }

    function NbLines($szerokosc, $txt) {
        $cw = &$this->CurrentFont['cw'];
        if ($szerokosc == 0)
            $szerokosc = $this->szerokosc - $this->rMargin - $this->x;
        $wmax = ($szerokosc - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }

    function CheckPageBreak($wysokosc) {
        if ($this->GetY() + $wysokosc > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
            $this->addFooter();
        }
    }

    function rysujTablice($header, $data) {
        $wysokosc = 5;
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($this->szerokosci[$i], $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', $header[$i]), 1, 0, $this->rozmieszczenieTekstu[$i], true);
        $this->Ln();
        if ($data) {
            foreach ($data as $d) {
                $nb = 0;
                for ($i = 0; $i < count($d); $i++)
                    $nb = max($nb, $this->NbLines($this->szerokosci[$i], $d[$i]));
                $w = $wysokosc * $nb;
                $this->CheckPageBreak($w);

                for ($i = 0; $i < count($d); $i++) {
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->Rect($x, $y, $this->szerokosci[$i], $w);
                    $this->MultiCell($this->szerokosci[$i], $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', $d[$i]), 0, $this->rozmieszczenieTekstu[$i]);
                    $this->SetXY($x + $this->szerokosci[$i], $y);
                }
                $this->Ln($w);
            }
        }
    }

    function rysujStawkiVAT($header, $data) {
        $wysokosc = 6;
        $this->Ln(6);
        if ($header[0] == '')
            $this->SetXY(($this->w - (array_sum($this->szerokosci) + $this->rMargin)) + $this->szerokosci[0], $this->GetY());
        else
            $this->SetXY($this->w - (array_sum($this->szerokosci) + $this->rMargin), $this->GetY());
        for ($i = 0; $i < count($header); $i++)
            if ($header[$i] != '')
                $this->Cell($this->szerokosci[$i], $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', $header[$i]), 1, 0, $this->rozmieszczenieTekstu[$i], true);
        $this->Ln();
        foreach ($data as $d) {
            $nb = 0;
            for ($i = 0; $i < count($d); $i++)
                $nb = max($nb, $this->NbLines($this->szerokosci[$i], $d[$i]));
            $w = $wysokosc * $nb;
            $this->CheckPageBreak($w);

            $h = 0;
            for ($i = 0; $i < count($d); $i++) {
                $x = ($this->w - (array_sum($this->szerokosci) + $this->rMargin)) + $h;
                $y = $this->GetY();
                $this->SetXY($x, $y);
                $this->Rect($x, $y, $this->szerokosci[$i], $w);
                $this->MultiCell($this->szerokosci[$i], $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', $d[$i]), 0, $this->rozmieszczenieTekstu[$i]);
                $this->SetXY($x + $this->szerokosci[$i], $y);
                $h += $this->szerokosci[$i];
            }
            $this->Ln($w);
        }
    }

    function rysujTytul($tytul) {
        $this->SetFont($this->font, '', 20);
        $this->Cell(190, 10, iconv('UTF-8', 'cp1250//TRANSLIT', $tytul), 0, 0, 'C', false);
        $this->SetFont($this->font, '', 10);
        $this->Ln(15);
    }

    function rysujSprzedawca($sprzedawca) {
        $this->sprzedawcaY = $this->GetY();
        $wysokosc = 5;
        $szerokosc = 85;
        $this->Cell($szerokosc, $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', 'Sprzedawca'), 0, 0, 'C', true);
        $this->Ln();
        $this->Rect($this->GetX(), $this->GetY(), $szerokosc, 0);

        $nb = 0;
        $nb = max($nb, $this->NbLines($szerokosc, $sprzedawca));
        $w = $wysokosc * $nb;
        $this->CheckPageBreak($w);

        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetXY($x, $y);
        $this->MultiCell($szerokosc, $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', $sprzedawca), 0, 'L');
        $this->Rect($x, $y + $w, $szerokosc, 0);
        $this->sprzedawcaEndY = $this->GetY();
    }

    function rysujNabywca($nabywca) {
        $wysokosc = 5;
        $szerokosc = 85;
        $this->SetXY($this->GetX() + $szerokosc + 20, $this->sprzedawcaY);
        $this->Cell($szerokosc, $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', 'Nabywca'), 0, 0, 'C', true);
        $this->Ln();
        $this->Rect($this->GetX() + $szerokosc + 20, $this->GetY(), $szerokosc, 0);

        $nb = 0;
        $nb = max($nb, $this->NbLines($szerokosc, $nabywca));
        $w = $wysokosc * $nb;
        $this->CheckPageBreak($w);

        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetXY($x + $szerokosc + 20, $y);
        $this->MultiCell($szerokosc, $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', $nabywca), 0, 'L');
        $this->Rect($x + $szerokosc + 20, $y + $w, $szerokosc, 0);
        if ($this->sprzedawcaEndY > $this->GetY())
            $this->SetXY($x, $this->sprzedawcaEndY);
        $this->Ln(5);
    }

    function rysujDataRow($title, $data) {
        $wysokosc = 5;
        $szerokosc = 45;
        $this->SetXY($this->w - ($this->rMargin + $szerokosc), $this->GetY());
        $this->Cell($szerokosc, $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', $title), 0, 0, 'C', true);
        $this->Ln();
        $this->Rect($this->w - ($this->rMargin + $szerokosc), $this->GetY(), $szerokosc, 0);

        $nb = 0;
        $nb = max($nb, $this->NbLines($szerokosc, $data));
        $w = $wysokosc * $nb;
        $this->CheckPageBreak($w);

        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetXY($this->w - ($this->rMargin + $szerokosc), $y);
        $this->MultiCell($szerokosc, $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', $data), 0, 'C');
    }

    function rysujSuma($title, $data) {
        $wysokosc = 8;
        $szerokosc = 26;
        $this->SetXY($this->w - ($this->rMargin + $szerokosc), $this->GetY());
        $this->Cell($szerokosc, 5, iconv('UTF-8', 'cp1250//TRANSLIT', $title), 0, 0, 'R', true);
        $this->Ln();
        $this->Rect($this->w - ($this->rMargin + $szerokosc), $this->GetY(), $szerokosc, 0);

        $this->SetFont($this->font, '', 15);

        $nb = 0;
        $nb = max($nb, $this->NbLines($szerokosc, $data));
        $w = $wysokosc * $nb;
        $this->CheckPageBreak($w);

        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetXY($this->w - ($this->rMargin + $szerokosc), $y);
        $this->MultiCell($szerokosc, $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', $data), 0, 'R');
        $this->SetFont($this->font, '', 10);
        $this->Ln(5);
    }

    function rysujPlatnosc($platnosc) {
        $wysokosc = 6;
        for ($i = 0; $i < count($platnosc); $i++) {
            $this->Cell($platnosc[$i][0], 6, iconv('UTF-8', 'cp1250//TRANSLIT', $platnosc[$i][2]), 1, 0, 'C', true);
            $nb = 0;
            $nb = max($nb, $this->NbLines($platnosc[$i][1], $platnosc[$i][3]));
            $w = $wysokosc * $nb;
            $this->CheckPageBreak($w);

            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $platnosc[$i][1], $w);
            $this->MultiCell($platnosc[$i][1], $wysokosc, iconv('UTF-8', 'cp1250//TRANSLIT', $platnosc[$i][3]), 0, 'R');
            $this->SetXY($x + $platnosc[$i][1], $y);
        }
        $this->Ln();
    }

    function rysujLogo($logo) {
        if ($logo)
            $this->Image($logo, $this->tMargin, $this->lMargin, -300);
    }

    function rysujWystawca($wystawca) {
        $this->SetFont($this->font, '', 10);
        $wysokosc = 30;
        $szerokosc = 85;
        $this->wystawcaY = $this->GetY();
        $this->SetXY($this->GetX(), $this->GetY());
        $this->Cell($szerokosc, 5, iconv('UTF-8', 'cp1250//TRANSLIT', 'Wystawca'), 0, 0, 'C', true);
        $this->Ln();
        $this->Rect($this->GetX(), $this->GetY(), $szerokosc, 0);

        $nb = 0;
        $nb = max($nb, $this->NbLines($szerokosc, $wystawca));
        $w = $wysokosc * $nb;
        $this->CheckPageBreak($w);

        $this->SetFont($this->font, '', 8);

        $x = $this->GetX();
        $y = $this->GetY();
        $this->MultiCell($szerokosc, $w, '', 0, 'C');
        $this->Ln($wysokosc);
        $this->SetXY($x, $y + $wysokosc);
        $this->Rect($this->GetX(), $this->GetY(), $szerokosc, 0);
        if ($wystawca)
            $this->MultiCell($szerokosc, 5, iconv('UTF-8', 'cp1250//TRANSLIT', 'Osoba upowaĹźniona do wystawienia: ' . $wystawca), 0, 'C');
        $this->SetFont($this->font, '', 10);
    }

    function rysujOdbiorca($odbiorca) {
        $this->SetFont($this->font, '', 10);
        $wysokosc = 30;
        $szerokosc = 85;
        $this->SetXY($this->GetX() + $szerokosc + 20, $this->wystawcaY);
        $this->Cell($szerokosc, 5, iconv('UTF-8', 'cp1250//TRANSLIT', 'Odbiorca'), 0, 0, 'C', true);
        $this->Ln();
        $this->Rect($this->GetX() + $szerokosc + 20, $this->GetY(), $szerokosc, 0);

        $nb = 0;
        $nb = max($nb, $this->NbLines($szerokosc, $odbiorca));
        $w = $wysokosc * $nb;
        $this->CheckPageBreak($w);

        $this->SetFont($this->font, '', 8);

        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetXY($x + $szerokosc + 20, $y);
        $this->MultiCell($szerokosc, $wysokosc, '', 0, 'C');
        $this->Ln($wysokosc);
        $this->SetXY($x + $szerokosc + 20, $y + $wysokosc);
        $this->Rect($x + $szerokosc + 20, $this->GetY(), $szerokosc, 0);
        if ($odbiorca)
            $this->MultiCell($szerokosc, 5, iconv('UTF-8', 'cp1250//TRANSLIT', 'Osoba upoważniona do odbioru: ' . $odbiorca), 0, 'C');
        $this->SetFont($this->font, '', 10);
    }

    function addFooter($text) {
        $y = $this->GetY();
        $x = $this->GetX();
        $this->SetFont($this->font, '', 8);
        $this->SetY($this->h - 15);
        $this->Cell(190, 5, "Strona " . $this->PageNo() . " z {nb}", 0, 1, "R");
        $this->SetY($this->h - 15);
        $this->Cell(190, 5, iconv('UTF-8', 'cp1250//TRANSLIT', $text), 0, 1, "L");
        $this->SetXY($x, $y);
        $this->SetFont($this->font, '', 10);
    }

}