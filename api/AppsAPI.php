<?php

class AppsAPI {
    
    private $appService;

    public function __construct(AppsService $appService) {
        $this->appService = $appService;
    }

    public function getAllApps() {
        $apps = $this->appService->getAllApps();
        echo json_encode($apps);
    }

    public function getAppById($id) {
        $app = $this->appService->getAppById($id);
        if ($app) {
            echo json_encode($app);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "App not found"));
        }
    }

    public function createApp($appData) {
        $app = $this->appService->createApp($appData);
        echo json_encode($app);
    }

    public function updateApp($id, $appData) {
        $app = $this->appService->updateApp($id, $appData);
        if ($app) {
            echo json_encode($app);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "App not found"));
        }
    }

    public function deleteApp($id) {
        $app = $this->appService->deleteApp($id);
        if ($app) {
            echo json_encode(array("message" => "App deleted successfully"));
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "App not found"));
        }
    }
}
