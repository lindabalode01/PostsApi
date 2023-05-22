<?php

namespace PostsApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PostsApi\Models\Comment;
use PostsApi\Models\Post;
use PostsApi\Models\User;

class ApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://jsonplaceholder.typicode.com'
        ]);
    }

    public function fetchAll(): array
    {
        try {
            if (!Cache::ifHas('all_articles')) {
                $response = $this->client->get('posts');
                $responseJson = $response->getBody()->getContents();
                Cache::save('all_articles', $responseJson, 120);
            } else {
                $responseJson = Cache::get('all_articles');
            }
            $articles = json_decode($responseJson);
            return $this->createCollection($articles);
        } catch (GuzzleException $e) {
            return [];
        }
    }

    public function getComments(int $postId): array
    {
        try {
            if (!Cache::ifHas('comments')) {
                $response = $this->client->get('comments?postId=' . $postId);
                $responseJson = $response->getBody()->getContents();
                Cache::save('comments', $responseJson, 120);
            } else {
                $responseJson = Cache::get('comments');
            }
            $allComments = json_decode($responseJson);
            $comments = [];
            foreach ($allComments as $comment) {
                $comments[] = new Comment(
                    $comment->postId,
                    $comment->id,
                    $comment->name,
                    $comment->email,
                    $comment->body
                );
            }
            return $comments;
        } catch (GuzzleException $e) {
            return [];
        }
    }

    public function getUsers(): array
    {
        try {
            if (!\PostsApi\Cache::ifHas('users')) {
                $response = $this->client->get('users/');
                $responseJson = $response->getBody()->getContents();
                Cache::save('users', $responseJson, 120);
            } else {
                $responseJson = Cache::get('users' );
            }
            $allUsers = json_decode($responseJson);
            $users = [];
            foreach ($allUsers as $user) {
                $users[] = new User(
                    $user->id,
                    $user->name,
                    $user->username,
                    $user->email,
                    $user->phone,
                    $user->website
                );
            }
            return $users;
        } catch (GuzzleException $e) {
            return [];
        }
    }
    public function getOneUser(int $id):?User
    {
        try {
            if (!\PostsApi\Cache::ifHas('user'.$id)) {
                $response = $this->client->get('users/'.$id);
                $responseJson = $response->getBody()->getContents();
                Cache::save('user'.$id, $responseJson, 120);
            } else {
                $responseJson = Cache::get('user'.$id );
            }
            $user = json_decode($responseJson);
           return new User(
                    $user->id,
                    $user->name,
                    $user->username,
                    $user->email,
                    $user->phone,
                    $user->website
                );


        } catch (GuzzleException $e) {
            return null;
        }
    }
    public function getArticleByUser(int $user):array
    {
        try {
            if (!Cache::ifHas('article_user'.$user)) {
                $response = $this->client->get('posts?userId='.$user);
                $responseJson = $response->getBody()->getContents();
                Cache::save('article_user'.$user, $responseJson, 120);
            } else {
                $responseJson = Cache::get('article_user'.$user);
            }
            $articleByUser = json_decode($responseJson);
            return $this->createCollection($articleByUser);
        } catch (GuzzleException $e) {
            return [];
        }
    }

    public function createCollection(array $postArray): array
    {
        $result = [];
        foreach ($postArray as $post) {
            $result[] = new Post(
                $post->title,
                $post->body,
                $post->userId
            );
        }
        return $result;
    }
}