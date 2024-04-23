<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Api;

class Media extends AbstractApi
{
    /**
     * Upload Media
     * @see https://docs.ultramsg.com/api/post/media/upload
     *
     * @param string $file from url or from your local device
     */
    public function upload(string $file): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/media/upload', http_build_query([
            'token' => $this->getToken(),
            'file' => $file,
        ]));
    }

    /**
     * Delete Media
     * @see https://docs.ultramsg.com/api/post/media/delete
     *
     * @param string $url the url of the media file
     */
    public function deleteMedia(string $url): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/media/delete', http_build_query([
            'token' => $this->getToken(),
            'url' => $url,
        ]));
    }

    /**
     * Delete all media files by date
     * @see https://docs.ultramsg.com/api/post/media/deleteByDate
     *
     * @param string $date month and year for example: 1-2023 or 01-2023
     */
    public function deleteByDate(string $date): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/media/deleteByDate', http_build_query([
            'token' => $this->getToken(),
            'date' => $date,
        ]));
    }
}
