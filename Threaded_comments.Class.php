    <?php
	//http://www.jongales.com/blog/2009/01/27/php-class-for-threaded-comments/
	//vähän muokattu
	class Threaded_comments  
    {  
          
        public $parents  = array();  
        public $children = array();  
      
        /** 
         * @param array $comments  
         */  
        function __construct($comments)  
        {  
            foreach ($comments as $comment)  
            {  
                if ($comment['vanhempi'] == NULL)  
                {  
                    $this->parents[$comment['idKommentti']][] = $comment;  
                }  
                else  
                {  
                    $this->children[$comment['vanhempi']][] = $comment;  
                }  
            }          
        }  
         
        /** 
         * @param array $comment 
         * @param int $depth  
         */  
        private function format_comment($comment, $depth)  
        {     
            for ($depth; $depth > 0; $depth--)  
            {  
                echo "\t";  
            }  
            echo "<li>";
			echo "<div class='content'>";			
            echo $comment['otsikko']; 
			echo "<br>";
			echo $comment['sisalto'];
			echo "<br>";
			echo $comment['idKayttaja'];
			echo "<br>";
			echo $comment['luontiAika'];
			echo "<br>";
			echo $comment['muokattu'];			
            echo "\n";
			echo "</div>";
			echo "</li>"; 
        }  
          
        /** 
         * @param array $comment 
         * @param int $depth  
         */   
        private function print_parent($comment, $depth = 0)  
        {     
            foreach ($comment as $c)  
            {  
			
			echo "<ul>";
                $this->format_comment($c, $depth);  
				  
                if (isset($this->children[$c['idKommentti']]))  
                {  
                    $this->print_parent($this->children[$c['idKommentti']], $depth + 1);
                }
				
			echo "</ul>";		
            }  
        }  
      
        public function print_comments()  
        {  
            foreach ($this->parents as $c)  
            {  
                $this->print_parent($c);  
            }  
        }  
        
    }  