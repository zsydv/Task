<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class UserTable
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;


        if (isset($_GET['name']) && $_GET['name'] == 'exporttoexcel') {
            return $this->exportToExcel();
        }
    }

    public function getUser()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM users";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $users;
        } catch (PDOException $e) {
            echo "Xəta: " . $e->getMessage();
            return false;
        }
    }




    public function exportToExcel()
    {


        try {
            $users = $this->getUser();


            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Müraciət');
            $sheet->setCellValue('B1', 'Ad');
            $sheet->setCellValue('C1', 'Soyad');
            $sheet->setCellValue('D1', 'Email');
            $sheet->setCellValue('E1', 'Telefon');

            $rowNumber = 2;
            foreach ($users as $user) {
                $sheet->setCellValue('A' . $rowNumber, $user['gender']);
                $sheet->setCellValue('B' . $rowNumber, $user['name']);
                $sheet->setCellValue('C' . $rowNumber, $user['surname']);
                $sheet->setCellValue('D' . $rowNumber, $user['email']);
                $sheet->setCellValue('E' . $rowNumber, $user['phone']);
                $rowNumber++;
            }



            $writer = new Xlsx($spreadsheet);
            $filename = 'user_list.xlsx';
            $writer->save($filename);




            $response = array(
                'success' => true,
                'fileUrl' => $filename
            );
            header('Content-Type: application/json');

            return json_encode($response);
        } catch (PDOException $e) {
            echo "Xəta: " . $e->getMessage();
            return false;
        }
    }
}
