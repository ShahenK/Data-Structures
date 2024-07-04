<?php

class Node {
    public function __construct(
        public mixed $data,
        public ?Node $next = null
    ) {}
}

class Queue {
    private ?Node $front = null;
    private ?Node $rear = null;

    public function enqueue(mixed $data): void {
        $newNode = new Node($data);
        if ($this->isEmpty()) {
            $this->front = $this->rear = $newNode;
        } else {
            $this->rear->next = $newNode;
            $this->rear = $newNode;
        }
    }

    public function dequeue(): mixed {
        if ($this->isEmpty()) {
            throw new UnderflowException("Queue is empty");
        }
        $data = $this->front->data;
        $this->front = $this->front->next;
        if ($this->front === null) {
            $this->rear = null;
        }
        return $data;
    }

    public function peek(): mixed {
        if ($this->isEmpty()) {
            throw new UnderflowException("Queue is empty");
        }
        return $this->front->data;
    }

    public function isEmpty(): bool {
        return $this->front === null;
    }

    public function printQueue(): void {
        $current = $this->front;
        while ($current !== null) {
            echo $current->data . " ";
            $current = $current->next;
        }
        echo PHP_EOL;
    }
}

// Example usage
$queue = new Queue();
$queue->enqueue(10);
$queue->enqueue(20);
$queue->enqueue(30);

echo "Queue elements: ";
$queue->printQueue();

echo "Dequeued element: " . $queue->dequeue() . PHP_EOL;

echo "Queue elements after dequeue: ";
$queue->printQueue();

echo "Front element: " . $queue->peek() . PHP_EOL;
