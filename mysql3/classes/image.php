<?php


function imageCreateFromAny($filepath) {

    $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()

    $allowedTypes = array(

        1,  // [] gif

        2,  // [] jpg

        3,  // [] png

        6   // [] bmp

    );

    if (!in_array($type, $allowedTypes)) {

        return false;

    }

    switch ($type) {

        case 1 :

            $im = imagecreatefromgif($filepath);

        break;

        case 2 :

            $im = imagecreatefromjpeg($filepath);

        break;

        case 3 :

            $im = imagecreatefrompng($filepath);

        break;

        case 6 :

            $im = imagecreatefrombmp($filepath);

        break;

    }    

    return $im;  

}
    class Image
    {
       
        public function generate_filename($length)
        {
            $array = array(0,1,2,3,4,5,6,7,9,'a','b','c','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            $text = "";
            for($x = 0; $x < $length;$x++)
            {
                $random = rand(0,61);
                $text .= $array[$random];
            }
            return $text;
        }
        public function crop_image($original_file_name,$cropped_file_name,$max_width,$max_height)
        {
            
            if(file_exists($original_file_name))
            {
                $original_image = imageCreateFromAny($original_file_name);
                
                $original_width = imagesx($original_image);

                $original_height = imagesy($original_image);

                if( $original_height > $original_width)
                {
                    //make width equal to max width;
                    $ratio = $max_width / $original_width;

                    $new_width = $max_width;

                    $new_height = $original_height * $ratio ;


                }else
                {
                    //make height equal to max height;
                    $ratio = $max_height / $original_height;

                    $new_height = $max_height;

                    $new_width = $original_width * $ratio ;
                }

                // adjust incase max width and height are different
                if($max_width != $max_height )
                {
                    if($max_height > $max_width)
                    {
                        if($max_height > $new_height)
                        {
                            $adjustment = ($max_height/ $new_height);
                        }else
                        {
                            $adjustment = ($new_height/ $max_height);
                        }

                        $new_width = $new_width *  $adjustment;
                        $new_height = $new_height *  $adjustment;
                    }else
                    {
                        if($max_width > $new_width)
                        {
                            $adjustment = ($max_width/ $new_width);
                        }else
                        {
                            $adjustment = ($new_width/ $max_width);
                        }

                        $new_width = $new_width *  $adjustment;
                        $new_height = $new_height *  $adjustment;
                    }
                }

                $new_image = imagecreatetruecolor($new_width,$new_height);
                imagecopyresampled($new_image,$original_image,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
                imagedestroy($original_image);

                if($max_width != $max_height )
                {
                    if( $max_width > $max_height)
                    {
                        $diff = ($new_height - $max_height);
                        if( $diff <0 )
                        {
                            $diff = $diff * -1;
                        }
                        
                        $y = round($diff/ 2);
                        $x = 0;

                    }else
                    {
                        $diff = ($new_width - $max_height);
                        if( $diff <0 )
                        {
                            $diff = $diff * -1;
                        }
                        $x = round($diff/ 2);
                        $y = 0;                    
                    }
                }else
                {
                    if( $new_height > $new_width)
                    {
                        $diff = ($new_height - $new_width);
                        $y = round($diff/ 2);
                        $x = 0;

                    }else
                    {
                        $diff = ($new_width - $new_height);
                        $x = round($diff/ 2);
                        $y = 0;                    
                    }
                }

                $new_cropped_image = imagecreatetruecolor($max_width,$max_height);
                imagecopyresampled($new_cropped_image,$new_image,0,0,$x,$y,$max_width,$max_height,$max_width,$max_height);
                imagedestroy($new_image);
                imagepng($new_cropped_image,$cropped_file_name,8);
                imagedestroy($new_cropped_image);
            }
        }
    }
?>
