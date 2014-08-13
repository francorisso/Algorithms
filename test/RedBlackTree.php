<?php

namespace test;

define("RED", 1);
define("BLACK", 0);

/**
* Red Black Tree, a 2-3 tree representation to be able to search and insert elements in a symbol table (is a BST)
* Properties: 
* - Red links lean left
* - No node has 2 red links connected to it
* - Every path from the root to a null link, has the same number of black links, this way we keep the tree balanced
*
* @author Robert Sedgewick - http://www.cs.princeton.edu/~rs/talks/LLRB/RedBlack.pdf
* @implementation Franco Risso <franco@720desarrollos.com>
*/
class RedBlackTree {
    private $root;

    /**
    * Searches for $key in the tree
    * @return $value associated with $key or null if $key is not in the tree
    */
    public function search( $key ){
        return $this->search_helper($key,$this->root);
    }

    private function search_helper( $key, $node ){
        if( empty($node) ){
            return null;
        }

        $compare = $this->compare_keys( $key, $node->key );
        if( $compare<0 ){
            return $this->search_helper( $key, $node->left );
        } elseif( $compare>0 ){
            return $this->search_helper( $key, $node->right );
        }

        return $node->value;
    }


    /**
    * Insertion of (key,value) node into the tree
    */
    public function insert($key, $value){
        $this->root = $this->insert_helper($this->root, $key, $value);
        $this->root->color = BLACK;
    }

    /**
    * Starts with basic BST insert, and then we do transformations to keep the red-black tree properties:
    * - Right child red: rotate left
    * - Left Child and Left-Left GrandChild red: rotate right
    * - Both children red: flip colors
    */
    private function insert_helper($node, $key, $value){
        if( empty($node) ){
            $node = new Node();
            $node->left = null;
            $node->right = null;
            $node->color = RED;
            $node->key = $key;
            $node->value = $value;
            $node->size = 1;
            return $node;
        }

        //BST insertion
        $compare = $this->compare_keys( $key, $node->key );
        if( $compare<0 ){
            $node->left = $this->insert_helper( $node->left, $key, $value );
        } elseif( $compare>0 ){
            $node->right = $this->insert_helper( $node->right, $key, $value );
        } else {
            $node->value = $value;
        }

        //Red-Black tree transformations
        //@note keep the order, the lack of else is intentional because one condition can happen after the previous one.
        if( $this->is_red($node->right) && !$this->is_red($node->left)){
            $node = $this->rotate_left($node);
        }
        if( $this->is_red($node->left) && $this->is_red($node->left->left)){
            $node = $this->rotate_right($node);
        }
        if( $this->is_red($node->right) && $this->is_red($node->left)){
            $this->flip_colors($node);
        }

        $node->size = $this->node_size( $node->left ) + $this->node_size( $node->right ) + 1;

        return $node;
    }

    /**
    * Deletion of $key
    */
    public function delete( $key ){
        $this->root = $this->delete_helper($this->root, $key);
        $this->root->color = BLACK;
    }

    /**
    * Searchs for the $key, finds it, remove it and then do transformations to keep the red-black tree properties:
    * - Right child red: rotate left
    * - Left Child and Left-Left GrandChild red: rotate right
    * - Both children red: flip colors
    */
    private function delete_helper($node, $key){
        
        $compare = $this->compare_keys( $key, $node->key );
        if( $compare<0 ){
            if (!$this->is_red($node->left) && !$this->is_red($node->left->left) ){
                $node = $this->move_red_left( $node );
            }
            $node->left = $this->delete_helper($node->left, $key);
        } else {
            if ($this->is_red($node->left)){ 
                $node = $this->rotate_right($node);
            }
            if ($compare == 0 && empty($node->right) ){
                return null;
            }

            if (!$this->is_red($node->right) && !$this->is_red($node->right->left)){
                $node = $this->move_red_right($node);
            }

            //do the compare again now in the possibly new node
            $compare = $this->compare_keys( $key, $node->key );
            if ($compare == 0){
                $min_right = $this->min_from_node( $node->right );
                $node->key = (empty($min_right)? null : $min_right->key);
                $node->value = (empty($min_right)? null : $min_right->value);
                $node->right = $this->delete_min_from_node($node->right);
            } else { 
                $node->right = $this->delete_helper($node->right, $key);
            }
        }
        
        return $this->fix_up($node);
    }

    /**
    * Gets the minimum node from a subtree $node
    */
    private function min_from_node($node){
        if($node==null){
            return null;
        }

        if($node->left==null){
            return $node;
        }

        return $this->min_from_node( $node->left );    
    }

    /**
    * If the $node.right.left subtree is red, we need to borrow from sibling by rotating 
    */
    private function move_red_left($node){ 
        $this->flip_colors($node);
        if(!empty($node->right) && $this->is_red($node->right->left)){
            $node->right = $this->rotate_right($node->right);
            $node = $this->rotate_left($node);
            $this->flip_colors($node);
        }
        return $node;
    }

    private function move_red_right($node){ 
        $this->flip_colors($node);
        if( !empty($node->left) && $this->is_red($node->left->left) ){
            $node = $this->rotate_right($node);
            $this->flip_colors($node);
        }
        return $node;
    }

    /**
    * Functions to delete the minimum
    */
    public function delete_min(){
        $this->root = $this->delete_min_from_node($this->root);
        $this->root->color = BLACK;
    }
    
    private function delete_min_from_node($node){
        if( empty($node->left) ){
            return null;           
        }

        if( !$this->is_red($node->left) && !$this->is_red($node->left->left) ){
            $node = $this->move_red_left($node);
        }
        
        $node->left = $this->delete_min_from_node($node->left);

        return $this->fix_up( $node );
    }

    /**
    * Transformations:
    * Rotate Left: when a red link is pointing right, we must rotate to the left
    * Rotate Right: rotate right a node, we use this for certain functions.
    * Flip Colors: To convert a 4-node into a 3-node
    */

    /**
    * The node in the right is rotated to the left, in this way we create a 2-3 node,
    * with the left value as $node and right value as $node_result
    * @return a $node_result so the parent of $node could change to be the parent of $node_result *after* the operation 
    * in the operation the parent is not changed  
    */
    private function rotate_left( $node ){
        $node_result = $node->right;
        $node->right = $node_result->left;
        $node_result->left = $node;
        $node_result->color = $node->color;
        $node->color = RED;  

        return $node_result;
    }

    /**
    * See rotate left, is the same transformation but to the right
    */
    private function rotate_right( $node ){
        $node_result = $node->left;
        $node->left = $node_result->right;
        $node_result->right = $node;
        $node_result->color = $node->color;
        $node->color = RED;  

        return $node_result;
    } 

    /**
    * Transformation from 4-node into 3-node, for that we split the node, 
    * by coloring the node to red and coloring the two children to black
    * ( remember: red link represent a 3-node )
    */
    private function flip_colors($node){
        $node->color = RED;
        if(!empty($node->right)){
            $node->right->color = BLACK;
        }
        if(!empty($node->left)){
            $node->left->color = BLACK;
        }
    }

    /**
    * When delete a node, this function fixes right-leaning reds and eliminate 4-nodes on the way up
    */
    private function fix_up( $node )
    {
        if ($this->is_red($node->right)){
            $node = $this->rotate_left($node);
        }
        if ($this->is_red($node->left) && $this->is_red($node->left->left)){
            $node = $this->rotate_right($node);
        }
        if ($this->is_red($node->left) && $this->is_red($node->right) ){
            $this->flip_colors($node);
        }

        return $node;
    }

    /**
    * Checks if a node is red, a node is red if the link to his parent is red
    * @param $node
    * @return true if is red, false otherwise
    */
    private function is_red( $node ){
        return (empty($node)? false : $node->color==RED);
    }

    private function node_size( $node ){
        return (empty($node)? 0 : $node->size);    
    }

    /**
    * The compare operation between keys, note that the <,> simbols are used to represent priority (as a heap),
    * Could be a compare ascendent order, or descendent order.
    * @return -1: $key1<$key2, 0: $key1==$key2, 1: $key2>$key1
    */
    private function compare_keys( $key1, $key2 ){
        if( $key1<$key2 ){
            return -1;
        } elseif( $key1>$key2 ){
            return 1;
        } else {
            return 0;
        }
    }


    public function to_string(){
        return $this->to_string_helper($this->root);
    }

    //level-transverse
    private function to_string_helper($node){
        if(empty($node)){
            return "null";
        }
        $result = $node->key." - color: ".($node->color==RED? "red" : "black");
        $result .= " \n".$node->key."-LEFT: ";
        $result .= $this->to_string_helper($node->left);
        $result .= " \n".$node->key."-RIGHT: ";;
        $result .= $this->to_string_helper($node->right);

        return $result;
    }
}

class Node {
    public $left;
    public $right;
    public $color;
    public $size;
    public $key;
    public $value;
}