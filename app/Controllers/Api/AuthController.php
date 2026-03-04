<?php
namespace App\Controllers\Api;

class AuthController extends ApiController {
    public function login() {
        $data = $this->getJsonPayload();
        if (!isset($data['identifier']) || !isset($data['password'])) {
            return $this->jsonResponse(['error' => 'Missing identifier or password'], 400);
        }

        $stmt = $this->db->prepare("SELECT * FROM register WHERE email = :identifier1 OR username = :identifier2 OR mobile = :identifier3");
        $stmt->execute([
            'identifier1' => $data['identifier'],
            'identifier2' => $data['identifier'],
            'identifier3' => $data['identifier']
        ]);
        $user = $stmt->fetch();

        if ($user && $user['password'] == $data['password']) {
            $token = base64_encode($user['id'] . ':' . $user['username']);
            $profileImage = !empty($user['uploadedfile']) ? '/matrimony/profile/' . $user['uploadedfile'] : null;
            return $this->jsonResponse([
                'status' => 'success',
                'message' => 'Login successful',
                'token' => $token,
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'profileImage' => $profileImage
                ]
            ]);
        }

        return $this->jsonResponse(['error' => 'Invalid credentials'], 401);
    }

    public function register() {
        $data = $this->getJsonPayload();
        
        $required = ['name', 'email', 'phone', 'gender', 'dateOfBirth', 'password'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                return $this->jsonResponse(['error' => "Missing required field: $field"], 400);
            }
        }

        $stmt = $this->db->prepare("SELECT id FROM register WHERE email = :email");
        $stmt->execute(['email' => $data['email']]);
        if ($stmt->fetch()) {
            return $this->jsonResponse(['error' => 'Email already registered'], 400);
        }

        $a=rand(100000,999999);
        $b='HM';
        $username=$b.$a;

        $stmt = $this->db->prepare("
            INSERT INTO register (name, email, mobile, gender, dob, password, username, status, c_date, profile, otp, refernce) 
            VALUES (:name, :email, :mobile, :gender, :dob, :password, :username, '1', :c_date, :profile, :otp, :refernce)
        ");

        $inserted = $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['phone'],
            'gender' => $data['gender'],
            'dob' => $data['dateOfBirth'],
            'password' => $data['password'],
            'username' => $username,
            'c_date' => date('d/m/Y'),
            'profile' => 'self',
            'otp' => rand(100000,999999),
            'refernce' => 'mobile'
        ]);

        if ($inserted) {
            $userId = $this->db->lastInsertId();
            $token = base64_encode($userId . ':' . $username);
            return $this->jsonResponse([
                'status' => 'success',
                'message' => 'Registration successful',
                'token' => $token,
                'user' => [
                    'id' => $userId,
                    'username' => $username,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'profileImage' => null
                ]
            ]);
        }

        return $this->jsonResponse(['error' => 'Registration failed'], 500);
    }
}
