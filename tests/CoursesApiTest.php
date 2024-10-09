<?php
use PHPUnit\Framework\TestCase;


class CoursesApiTest extends TestCase {
   
    public function testAddCourse() {
       $data = [
            "title" => "Introduction à PHP",
           "description" => "Cours pour débutants en PHP",
           "level" => "Débutant"
       ];

        $ch = curl_init('http://localhost:8080/projects/projetTestYello/api.php');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $this->assertContains("Cours ajouté avec succès", $response);
        curl_close($ch);
   
     if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        echo "cURL error: $error_msg\n"; 
   }
    
  //  curl_close($ch);
    
    
   var_dump($response); 

    
    $responseData = json_decode($response, true);

    
   if ($responseData === null) {
       echo "Error decoding JSON: " . json_last_error_msg() . "\n"; 
   }

   
    $this->assertArrayHasKey('message', $responseData);
    $this->assertStringContainsString("Cours ajouté avec succès", $responseData['message']);
    //}
    }
}
?>
