<?php
class UserRegistration
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerUser($gender, $name, $surname, $email, $phone)
    {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo "Bu email istifadə edilmişdir.";
            } else {
                $password = $this->generateRandomPassword();
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $insertQuery = "INSERT INTO users (gender, name, surname, email, phone, password) VALUES (:gender, :name, :surname, :email, :phone, :password)";
                $insertStmt = $this->pdo->prepare($insertQuery);
                $insertStmt->bindParam(':gender', $gender);
                $insertStmt->bindParam(':name', $name);
                $insertStmt->bindParam(':surname', $surname);
                $insertStmt->bindParam(':email', $email);
                $insertStmt->bindParam(':phone', $phone);
                $insertStmt->bindParam(':password', $hashedPassword);

                if ($insertStmt->execute()) {
                    $emailSender = new EmailSender();
                    $emailSubject = 'Qeydiyyat uğurla tamamlandı!';
                    $emailMessage = "Sizin qeydiyyatınız uğurla tamamlandı.\n\n";
                    $emailMessage .= "Email: " . $email . "\n";
                    $emailMessage .= "Şifrə: " . $password . "\n";
                    $emailSender->sendEmail($emailSubject, $email, $emailMessage);

                    $emailSender->sendSupportEmail($name, $surname, $email, $phone);

                    echo "Qeydiyyat uğurla tamamlandı. Məlumatlarınız e-mailinizə göndərildi.";
                } else {
                    echo "Qeydiyyat zamanı xəta baş verdi.";
                }
            }
        } catch (PDOException $e) {
            echo "PDO Xətası: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Xəta: " . $e->getMessage();
        }
    }

    private function generateRandomPassword($length = 10)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charLength = strlen($chars);
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, $charLength - 1);
            $password .= $chars[$randomIndex];
        }

        return $password;
    }
}

?>