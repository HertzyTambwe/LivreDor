<?php
require_once 'Message.php';
class GuestBook  
{

    private $file;
    public function __construct(string $file) {
        $directory = dirname($file);
        if (!is_dir($directory)){
            mkdir($directory, 0777, true);
        }
        if (!file_exists($file)){
            touch($file);
        }
        $this->file = $file;
    }
    public function addMessage(Message $message) : void
    {
        file_put_contents($this->file, $message->toutJSON(). PHP_EOL, FILE_APPEND);
    }

    public function getMEssage() : array
    {
        $content = trim(file_get_contents($this->file));
        $messages = [];
        $lines = explode(PHP_EOL, $content);
        foreach($lines as $line){
            $messages[] = Message::fromJSOMN($line);
        }
        return array_reverse($messages);
    }
}
