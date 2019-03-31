<?php


namespace PageAnalyzer\Dto;


class DomainData
{
    /** @var int|null */
    private $code;
    /** @var string|null */
    private $body;
    /** @var int|null */
    private $contentLength;
    /** @var string|null */
    private $h1;
    /** @var string|null */
    private $keywords;
    /** @var string|null */
    private $description;

    /**
     * @return int|null
     */
    public function getCode(): ?int
    {
        return $this->code;
    }

    /**
     * @param  int|null  $code
     *
     * @return DomainData
     */
    public function setCode(?int $code): DomainData
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param  string|null  $body
     *
     * @return DomainData
     */
    public function setBody(?string $body): DomainData
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getContentLength(): ?int
    {
        return $this->contentLength;
    }

    /**
     * @param  int|null  $contentLength
     *
     * @return DomainData
     */
    public function setContentLength(?int $contentLength): DomainData
    {
        $this->contentLength = $contentLength;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getH1(): ?string
    {
        return $this->h1;
    }

    /**
     * @param  string|null  $h1
     *
     * @return DomainData
     */
    public function setH1(?string $h1): DomainData
    {
        $this->h1 = $h1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    /**
     * @param  string|null  $keywords
     *
     * @return DomainData
     */
    public function setKeywords(?string $keywords): DomainData
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param  string|null  $description
     *
     * @return DomainData
     */
    public function setDescription(?string $description): DomainData
    {
        $this->description = $description;

        return $this;
    }
}
