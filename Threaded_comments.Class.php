    <?php
	//http://www.jongales.com/blog/2009/01/27/php-class-for-threaded-comments/
	//vähän muokattu, itseasiassa aika rankasti : TuoKy
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
                if ($comment['vanhempi'] == 0)  
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
			 <div class='content'>\n			
             {$comment['otsikko']}
			 <br>\n
			 {$comment['sisalto']}
			 <br>\n
			 {$comment['idKayttaja']}
			 <br>\n
			 {$comment['luontiAika']}
			 <br>\n
			 {$comment['muokattu']}
			 
OUTPUTEND;
		echo $output;
		// Jaoin tämän sen takia, että nyt kommentointi nappula ei tule näkyviin jos ei ole kirjautuneena. Manninen
		if (@$_SESSION['app2_islogged'] != false) echo "<span class='right'><button type='button' class='btn btn-default' data-toggle='collapse' data-target='#{$comment['idKommentti']}'>Kommentoi</button></span><br>";
		echo "<br></div>";
		echo "<div id='{$comment['idKommentti']}' class='collapse' class='commentDiv'>			 		
			<div class='content'>			
			<form method='post' action='newComment.php?comment= {$comment['idKommentti']}'>
			<label>Otsikko</label>
				<input type='text' name='otsikko' maxlength='38' required> <br/>
			<label>Sisältö</label>	
				<textarea name='newComment' class='Comment' >  </textarea>
				<input type='hidden' name='idKommentti' value='{$comment['idKommentti']}'>
					<button type='submit' name ='post' class='btn btn-default'>Post</button>								
			</form>					
			</div>	
			</div>	 
			</li> ";	
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