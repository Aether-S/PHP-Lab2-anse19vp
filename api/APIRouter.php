<?php

class APIRouter {

    private $pathParts;
    private $queryParams;

    public function __construct($pathParts, $queryParams) {
        $this->pathParts = $pathParts;
        $this->queryParams = $queryParams;
    }

    public function handleRequest() {
        $resource = $this->pathParts[1];
        $id = isset($this->pathParts[2]) ? $this->pathParts[2] : null;

        // Load appropriate service and API classes
        switch($resource) {
            case "apps":
                require_once("../business-logic/AppsService.php");
                require_once("../api/AppsAPI.php");
                $appService = new AppsService();
                $api = new AppsAPI($appService);
                break;

            // Add other cases for other resources

            default:
                http_response_code(404);
                echo json_encode(array("message" => "Resource not found"));
                return;
        }

        // Call appropriate method based on HTTP method
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                if ($id) {
                    $api->getAppById($id);
                } else {
                    $api->getAllApps();
                }
                break;
            case "POST":
                $postData = json_decode(file_get_contents("php://input"), true);
                $api->createApp($postData);
                break;
            case "PUT":
                $putData = json_decode(file_get_contents("php://input"), true);
                $api->updateApp($id, $putData);
                break;
            case "DELETE":
                $api->deleteApp($id);
                break;
            default:
                http_response_code(405);
                echo json_encode(array("message" => "Method not allowed"));
                break;
        }
    }
}
