<?

class Node
{
	public function __construct(
		public int $value, 
		public ?Node $left=null,
		public ?Node $right=null
	) {}
	
}

class BST
{
	public ?Node $root=null;
	
	public function insert(int $value)
	{
		$newNode = new Node($value);
		
		if ($this->root === null) {
			$this->root = $newNode;
		} else {
			$currentNode = $this->root;
			while (true)
			{
				// echo $currentNode->value." ".$value;
				if ($currentNode->value > $value) {
					if (!$currentNode->left) {
						$currentNode->left = $newNode;
						return $this;
					}
					$currentNode = $currentNode->left;
				} else {
					if (!$currentNode->right) {
						$currentNode->right = $newNode;
						return $this;
					}
					$currentNode = $currentNode->right;
				}
			}
		}
	}
	
	public function lookup(int $value) :mixed
	{
		if(!$this->root) {
			return false;
		}
		
		$currentNode = $this->root;
		
		while ($currentNode)
		{
			if ($value > $currentNode->value) {
				$currentNode = $currentNode->right;
			} else if ($value < $currentNode->value) {
				$currentNode = $currentNode->left;
			} else if ($value === $currentNode->value){
				return $currentNode;
			}
		}
		return false;
	}
	
	public function remove(int $value)
	{
		if (!$this->root) {
			return false;
		}
		$currentNode = $this->root;
		$parentNode = null;
		while ($currentNode)
		{
			if ($value < $currentNode->value) {
				$parentNode = $currentNode;
				$currentNode = $currentNode->left;
			} elseif ($value > $currentNode->value) {
				$parentNode = $currentNode;
				$currentNode = $currentNode->right;
			} elseif ($currentNode->value === $value) {
			//We have a match, get to work!
			//Option 1: No right child:
				if ($currentNode->right === null) {
					if ($parentNode === null) {
						$this->root = $currentNode->left;
					} else {
			//if parent > current value, make current left child a child of parent
						if ($currentNode->value < $parentNode->value) {
							$parentNode->left = $currentNode->left;
			//if parent < current value, make left child a right child of parent
						} elseif ($currentNode->value > $parentNode->value) {
							$parentNode->right = $currentNode->left;
						}
					}
			//Option 2: Right child which doesnt have a left child
				} elseif ($currentNode->right->left === null) {
					$currentNode->right->left = $currentNode->left;
					if ($parentNode === null) {
						$this->root = $currentNode->right;
					} else {
			//if parent > current, make right child of the left the parent
						if ($currentNode->value < $parentNode->value) {
							$parentNode->left = $currentNode->right;
			//if parent < current, make right child a right child of the parent
						} elseif ($currentNode->value > $parentNode->value) {
							$parentNode->right = $currentNode->right;
						}
					}
			//Option 3: Right child that has a left child
				} else {
			//find the Right child's left most child
					$leftmost = $currentNode->right->left;
					$leftmostParent = $currentNode->right;
					while ($leftmost->left !== null) {
						$leftmostParent = $leftmost;
						$leftmost = $leftmost->left;
					}
			//Parent's left subtree is now leftmost's right subtree
					$leftmostParent->left = $leftmost->right;
					$leftmost->left = $currentNode->left;
					$leftmost->right = $currentNode->right;
					if ($parentNode === null) {
						$this->root = $leftmost;
					} else {
						if ($currentNode->value < $parentNode->value) {
							$parentNode->left = $leftmost;
						} elseif ($currentNode->value > $parentNode->value) {
							$parentNode->right = $leftmost;
						}
					}
				}
				return true;
			}
		}
	}
}

$bst = new BST();
$bst->insert(10);
$bst->insert(5);
$bst->insert(12);
$bst->insert(4);
$bst->insert(1);
$bst->insert(3);
$bst->insert(2);
$bst->remove(5);
var_dump($bst->root);
$bst->lookup(6);
var_dump($bst->lookup(10));
