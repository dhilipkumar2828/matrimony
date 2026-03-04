<?php
namespace App\Controllers\Api;

class MetadataController extends ApiController {
    public function getEducation() {
        // No authentication needed for dropdown options usually, 
        // but can be added if required: $user = $this->authenticate();

        try {
            $stmt = $this->db->prepare("SELECT id, education FROM education WHERE temp_id = 1 ORDER BY education ASC");
            $stmt->execute();
            $educationList = $stmt->fetchAll();

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $educationList
            ]);
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => 'Failed to fetch education data'], 500);
        }
    }
}
