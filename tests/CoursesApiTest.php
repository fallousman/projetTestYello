<?php
use PHPUnit\Framework\TestCase;

class CoursesApiTest extends TestCase
{
    private $apiUrl = 'http://localhost:8080/projects/projetTestYello/api.php';

    public function testPostCourse()
    {
        $data = [
            'title' => 'Cours de Test1',
            'description' => 'Description du cours de test1',
            'level' => 'Débutant'
        ];

        // Requête POST
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);
        
        // Assertions pour vérifier la réponse du POST
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Cours ajouté avec succès', $responseData['message']);
    }

    public function testGetCourses()
    {
        // Requête GET
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);

        // Assertions pour vérifier la réponse du GET
        $this->assertIsArray($responseData);
        $this->assertNotEmpty($responseData);
    }

    public function testPutCourse()
    {
        $updatedData = [
            'title' => 'Cours de Test Modifié',
            'description' => 'Description modifiée',
            'level' => 'Intermédiaire'
        ];

        
        $courseId = 5; 
        $ch = curl_init($this->apiUrl . '?id=' . $courseId);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($updatedData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);

        // Assertions pour vérifier la réponse du PUT
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Cours mis à jour avec succès', $responseData['message']);
    }

    public function testDeleteCourse()
    {
        
        $courseId = 2;
        $ch = curl_init($this->apiUrl . '?id=' . $courseId);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);

        // Assertions pour vérifier la réponse du DELETE
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Cours supprimé avec succès', $responseData['message']);
    }
}
