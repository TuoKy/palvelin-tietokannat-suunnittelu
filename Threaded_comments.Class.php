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
        private function format_comment($comment)  
        {   
			$output = <<<OUTPUTEND
             <li>
			 <div class='content'>			
             {$comment['otsikko']}
			 <br>
			 {$comment['sisalto']}
			 <br>
			 {$comment['idKayttaja']}
			 <br>
			 {$comment['luontiAika']}
			 <br>
			 {$comment['muokattu']}
			 <span class='right'><button type='button' class='btn btn-default'>Kommentoi</button></span><br>			
             \n
			 </div>
			 </li> 
OUTPUTEND;
			echo $output;
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
                    $this->print_parent($this->children[$c['idKommentti']]);
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