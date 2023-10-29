<?php
class Response
{
    private $code;
    private $contentType;

    public function __construct(string $content_type, string $code)
    {
		if($content_type) {
			$this->contentType = $content_type;
		}else{
			$this->contentType = false;
		}

        $this->code = $code;
    }

    public function send(): void
    {
        http_response_code($this->code);
		if($this->contentType) {
			header('Content-Type: ' . $this->contentType);
		}
    }
}