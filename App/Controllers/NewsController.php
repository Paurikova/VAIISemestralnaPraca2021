<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\News;

class NewsController extends AControllerRedirect
{
    public function index()
    {
        //nope
    }

    public function news()
    {
        try {
            $news = News::getAll();
        } catch (\Exception $e) {
            $this->redirect('news','news',['error' => $e->getMessage()]);
        }
        return $this->html(
            [
                'error' => $this->request()->getValue('error'),
                'news' => $news
            ]);

    }

    public function new()
    {
        try {
            $new = News::getOne($this->request()->getValue('newID'));
        } catch (\Exception $e) {
            $this->redirect('news','news',['error' => $e->getMessage()]);
        }
        return $this->html(
            [
                'new' => $new
            ]);
    }
}