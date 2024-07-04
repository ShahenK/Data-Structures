<?php

class Node {
    public function __construct(
        public mixed $data,
        public ?Node $next = null
    ) {}
}

class Stack {
    private ?Node $top = null;

    public function push(mixed $data): void {
        $this->top = new Node($data, $this->top);
    }

    public function pop(): mixed {
        if ($this->isEmpty()) {
            throw new UnderflowException("Stack is empty");
        }
        $data = $this->top->data;
        $this->top = $this->top->next;
        return $data;
    }

    public function peek(): mixed {
        if ($this->isEmpty()) {
            throw new UnderflowException("Stack is empty");
        }
        return $this->top->data;
    }

    public function isEmpty(): bool {
        return $this->top === null;
    }

    public function printStack(): void {
        $current = $this->top;
        while ($current !== null) {
            echo $current->data . " ";
            $current = $current->next;
        }
        echo PHP_EOL;
    }
}

// Example usage
$stack = new Stack();
$stack->push(10);
$stack->push(20);
$stack->push(30);

echo "Stack elements: ";
$stack->printStack();

echo "Popped element: " . $stack->pop() . PHP_EOL;
echo "Popped element: " . $stack->pop() . PHP_EOL;
echo "Popped element: " . $stack->pop() . PHP_EOL;
$stack->push(40);

echo "Stack elements after pop: ";
$stack->printStack();

echo "Top element: " . $stack->peek() . PHP_EOL;
