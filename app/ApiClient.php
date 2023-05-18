<?php

namespace PostsApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use POstsApi\Cache;
use PostsApi\Models\Comment;
use PostsApi\Models\Post;
use PostsApi\Models\User;

class ApiClient
{
    private Client $client;
    private const BASE_URI = 'https://jsonplaceholder.typicode.com/';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchAll(string $id = null): array
    {
        try {
            if (!Cache::ifHas('all_articles' . $id)) {
                $response = $this->client->get(self::BASE_URI . "articles/" . $id);
                $responseJson = $response->getBody()->getContents();
                Cache::save('all_articles' . $id, $responseJson, 120);
            } else {
                $responseJson = Cache::get('all_articles' . $id);
            }
            $articles = json_decode($responseJson);
            return $this->createCollection($articles);
        } catch (GuzzleException $e) {
            return [];
        }
    }

    public function getComments(string $id): array
    {
        try {
            if (!Cache::ifHas('comments' . $id)) {
                $response = $this->client->get(self::BASE_URI . "comments/" . $id);
                $responseJson = $response->getBody()->getContents();
                Cache::save('comments' . $id, $responseJson, 120);
            } else {
                $responseJson = Cache::get('comments' . $id);
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

    public function getUsers(string $id = null): array
    {
        try {
            if (!\PostsApi\Cache::ifHas('users' . $id)) {
                $response = $this->client->get(self::BASE_URI . "users/" . $id);
                $responseJson = $response->getBody()->getContents();
                Cache::save('users' . $id, $responseJson, 120);
            } else {
                $responseJson = Cache::get('users' . $id);
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
                    $user->website,
                    $user->company
                );
            }
            return $users;
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