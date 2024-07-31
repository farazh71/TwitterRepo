<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class FileController extends Controller
{
    public function serve($filename)
    {
        $path = WRITEPATH . 'uploads/' . $filename;

        if (file_exists($path)) {
            // Serve the file for download
            return $this->response->download($path, null)
                                  ->setHeader('Content-Type', mime_content_type($path));
        }

        return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                              ->setBody('File not found.');
    }
}
