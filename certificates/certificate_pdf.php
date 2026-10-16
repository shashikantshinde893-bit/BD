<?php
require_once "../config/db.php";
require_once "../fpdf/fpdf.php";

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { die("Invalid donor ID"); }

$stmt = $conn->prepare("SELECT * FROM donors WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$donor = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$donor) { die("Donor not found"); }

/* ---------------- Custom PDF class ---------------- */
class PDF extends FPDF {
    public $donor = null; // Initialized for PHP 8.2+

    function Header() {
        // Outer thick border
        $this->SetDrawColor(178, 34, 52); // deep red
        $this->SetLineWidth(2);
        $this->Rect(8, 8, 194, 281);
        // Inner thin border
        $this->SetLineWidth(0.5);
        $this->Rect(12, 12, 186, 273);
    }

    function Footer() {
        $this->SetY(-25);
        $this->SetFont('Helvetica','I',9);
        $this->SetTextColor(120,120,120);
        $this->Cell(0,5,"This is a computer-generated certificate. No signature required.",0,0,'C');
    }

    function Title() {
        $this->SetFillColor(178,34,52);
        $this->SetTextColor(178,34,52);
        $this->SetFont('Helvetica','B',26);
        $this->SetY(35); // Pushed down slightly for better vertical balance
        $this->Cell(0,15,"BLOOD DONATION",0,1,'C');
        
        $this->SetFont('Helvetica','',14);
        $this->Cell(0,8,"MANAGEMENT SYSTEM",0,1,'C');
        $this->Ln(6);

        $this->SetDrawColor(178,34,52);
        $this->SetLineWidth(0.8);
        $this->Line(70, $this->GetY(), 140, $this->GetY());
        $this->Ln(8);

        $this->SetFont('Helvetica','B',30);
        $this->Cell(0,15,"Certificate of Appreciation",0,1,'C');
        $this->Ln(10);
    }

    function Body() {
        $d = $this->donor;

        $this->SetFont('Helvetica','',14);
        $this->SetTextColor(60,60,60);
        $this->Cell(0,10,"This certificate is proudly presented to",0,1,'C');
        $this->Ln(4);

        // Donor name
        $this->SetFont('Helvetica','B',26);
        $this->SetTextColor(178,34,52);
        $this->Cell(0,14, strtoupper($d['name']),0,1,'C');

        $this->SetDrawColor(200,200,200);
        $this->SetLineWidth(0.3);
        $this->Line(50, $this->GetY(), 160, $this->GetY());
        $this->Ln(8);

        // Description (Handles NULL donation dates gracefully)
        $donationDate = $d['last_donation_date'] ? date("d F Y", strtotime($d['last_donation_date'])) : "N/A";
        
        $this->SetFont('Helvetica','',13);
        $this->SetTextColor(60,60,60);
        $text = "in recognition of their noble act of donating blood on "
              . $donationDate
              . ".\n\nYour generous contribution has helped save lives and brings hope to those in need. "
              . "We sincerely thank you for your compassion and humanitarian spirit.";
        $this->MultiCell(0, 8, $text, 0, 'C');
        $this->Ln(15);

        // Details box header
        $this->SetFillColor(250, 240, 240);
        $this->SetTextColor(60,60,60);
        $this->SetFont('Helvetica','B',12);
        $this->Cell(0,10,"Donor Details",0,1,'C',true);
        $this->Ln(6);

        // --- Centered Details Block ---
        // A4 width is 210mm. We want a 100mm wide block (40mm labels + 60mm values).
        // 210 / 2 = 105. 105 - 50 = 55. So we start at X = 55mm.
        
        $this->SetX(55);
        $this->SetFont('Helvetica','',12);
        $this->Cell(40,9,"Blood Group:",0,0,'L');
        $this->SetFont('Helvetica','B',12);
        $this->SetTextColor(178,34,52);
        $this->Cell(60,9,$d['blood_group'],0,1,'L');

        $this->SetX(55);
        $this->SetFont('Helvetica','',12);
        $this->SetTextColor(60,60,60);
        $this->Cell(40,9,"Age:",0,0,'L');
        $this->Cell(60,9,$d['age'] . " years",0,1,'L');

        $this->SetX(55);
        $this->Cell(40,9,"Gender:",0,0,'L');
        $this->Cell(60,9,$d['gender'],0,1,'L');

        $this->SetX(55);
        $this->Cell(40,9,"Contact:",0,0,'L');
        $this->Cell(60,9,$d['phone'],0,1,'L');

        $this->Ln(25); // Space before signatures

        // Signature lines (Perfectly centered)
        $this->SetFont('Helvetica','',11);
        $this->Cell(90,8,"________________________",0,0,'C');
        $this->Cell(10,8,"",0,0);
        $this->Cell(90,8,"________________________",0,1,'C');

        $this->Cell(90,6,"Blood Bank Coordinator",0,0,'C');
        $this->Cell(10,6,"",0,0);
        $this->Cell(90,6,"Date: " . date("d-m-Y"),0,1,'C');
    }
}

/* ---------------- Build PDF ---------------- */
$pdf = new PDF('P','mm','A4');
$pdf->donor = $donor;
$pdf->AddPage();
$pdf->Title();
$pdf->Body();

$filename = "Certificate_" . preg_replace('/\s+/', '_', $donor['name']) . ".pdf";
$pdf->Output("D", $filename); // "D" = Force download