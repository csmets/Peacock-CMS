<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

	session_start();
	include_once("initPeacock.php");
	$peacock = new Peacock;
	$SQLRW = new SQLRW;
	$username = $_SESSION['username'];
    $peacock->checkUser($username);
	
	$subType = $_POST['subType'];
	
	if (isset($subType)){
			
		//=============================================================
		//   Add Category	
		//=============================================================
		if ($subType == 'addCategory'){
			
			$categoryName = $_POST['categoryname'];

		    if (isset($categoryName)){
		        $sqlconnect = new Connectdb;
		        $db = $sqlconnect->connectTo();
		        mysqli_query($db,"INSERT INTO categories (category) VALUES ('$categoryName')");
		        $db->close();
		    }
		
		    header("location:controlpanel.php");
			
		}
		//=============================================================
		
		//=============================================================
		
		
		
		//=============================================================
		//   Add to Category	
		//=============================================================
		elseif ($subType == 'addToCategory'){
			
			$postID = $_POST['id'];
		    $category = $_POST['category'];
			
			if(isset($postID)){
				
				$sqlconnect = new Connectdb;
			    $db = $sqlconnect->connectTo();
			    $sendToDatabase = "UPDATE blog SET category='$category' WHERE id='$postID'";
			
			    mysqli_query($db,$sendToDatabase);
			    $db->close();
			    header("location:controlpanel.php");
				
			}else{
				echo "No Post ID Given";
			}
		}
		//=============================================================

		//=============================================================
		
		
		
		
		
		
		//=============================================================
		//   Add User / Create User	
		//=============================================================
		elseif ($subType == 'addUser'){
			
			$avatar = $_POST['avatar'];
		    $username = $_POST['newusername'];
		    $password = $_POST['password'];
		    $retypepassword = $_POST['retypepassword'];
		    $firstname = $_POST['firstname'];
		    $lastname = $_POST['lastname'];
		    $email = $_POST['email'];
		    $acctype = $_POST['accounttype'];
		
		    $errorMessage1 = "Passwords do not match";
		    $errorMessage2 = "Please do not leave any items blank";
		
		    if ($username != null && $password != null && $retypepassword != null && $firstname != null &&
		    $lastname != null && $email != null){
		    	
		        if ($password == $retypepassword)
		        {
		            //$password = md5($password); LEGACY
		            $password = hash('ripemd256',$password);
		            $sqlconnect = new Connectdb;
		            $db = $sqlconnect->connectTo();
					if ($avatar != 'none'){
						mysqli_query($db,"
						INSERT INTO users (username, password, firstname, lastname, email, acctype, profileimg)
						VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$acctype', '$avatar')");
					}
					else {
						mysqli_query($db,"
						INSERT INTO users (username, password, firstname, lastname, email, acctype)
						VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$acctype')");
					}
		            $db->close();
		            header("location:controlpanel.php");
		        }
		        else{
		            header("location:AddUser.php?error=$errorMessage1");
		        }
		    }
		    else {
		        header("location:AddUser.php?error=$errorMessage2");
		    }   
			
		}
		//=============================================================

		//=============================================================
		
		
		
		
		
		
		//=============================================================
		//   Arrange Pages	
		//=============================================================
		elseif ($subType == 'arrangePages'){
			
			if (isset($_REQUEST['data'])){
    	
				$data = $_REQUEST['data'];
				parse_str($data, $str);
				$menu = $str['item'];
				
				$sqlconnect = new Connectdb;
			    $db = $sqlconnect->connectTo();
				
				foreach ($menu as $key => $value){
					$key = $key + 1;
					$sendToDatabase = "UPDATE pages SET pageorder='$key' WHERE id='$value'";
					mysqli_query($db,$sendToDatabase);
				}
				
			    $db->close();
		   }else{
		   	header("location:ArrangePages.php");
		   }
			
		}
		//=============================================================

		//=============================================================
		
		
		
		
		
		
		
		//=============================================================
		//   Add Blog Entry
		//=============================================================
		elseif ($subType == 'blogSubmit'){

            $bodycontent = $_POST['postcontent'];
            $SQLbodycontent = addslashes($bodycontent);

			$pagename = $_POST['postname'];
			$pageType = 'blog';
			$isDraft = $_POST['draft'];
			$postImage = $_POST['postimage'];

			
			$date = date('Y-m-d H:i:s');
            
            $sqlconnect = new Connectdb;
            $db = $sqlconnect->connectTo();
			
			if ($pagename && $SQLbodycontent){
				if ($postImage != 'none'){
                    if ($isDraft == 'yes'){
                        $query = "
                        INSERT INTO blog (posttitle, postcontent, draft, date, user, image, status)
                        VALUES ('$pagename', '$SQLbodycontent', '$isDraft', '$date', '$username', '$postImage', 'draft')
                        ";
                    }else{
                        $query = "
                        INSERT INTO blog (posttitle, postcontent, draft, date, user, image)
                        VALUES ('$pagename', '$SQLbodycontent', '$isDraft', '$date', '$username', '$postImage')
                        ";
                    }
					
					mysqli_query($db,$query);
				}else{
                    if ($isDraft == 'yes'){
                        $query = "
                        INSERT INTO blog (posttitle, postcontent, draft, date, user, image, status)
                        VALUES ('$pagename', '$SQLbodycontent', '$isDraft', '$date', '$username', '', 'draft')
                        ";
                    }else{
                       $query = "
                        INSERT INTO blog (posttitle, postcontent, draft, date, user, image)
                        VALUES ('$pagename', '$SQLbodycontent', '$isDraft', '$date', '$username', '')
                        "; 
                    }
					
					mysqli_query($db,$query);
				}
			    mysqli_query($db,"UPDATE pages SET status='active' WHERE pagename='$pageType'");
				header("location:controlpanel.php");
			}
			elseif($pagename == null){
				$errorMsg = "No Title Name Given";
				header("location:controlpanel.php?error=".$errorMsg);
			}
			elseif($bodycontent == null){
				$errorMsg = "Page has no content";
				header("location:controlpanel.php?error=".$errorMsg);
			}
			else{
				$errorMsg = "ERROR! No Pass of any data";
				header("location:controlpanel.php?error=".$errorMsg);
			}
            
            $postID = mysqli_insert_id($db);
            
            $contentArray = array();
            $contentArray['title'] = $pagename;
            $contentArray['body'] = $bodycontent;
            $peacock->storeToFile('view/backups/posts/postBackup-'.$postID.'.json',$contentArray, 'JSON');
            
            $db->close();
			
		}
		//=============================================================

		//=============================================================
		
		
		
		
		
		//=============================================================
		//   Change Password
		//=============================================================
		elseif ($subType == 'changePassword'){
			
			$userID = $_POST['id'];
		    $password = $_POST['password'];
		    $retypepassword = $_POST['retypepassword'];
		    $errorMessage1 = "Please enter all fields";
		    $errorMessage2 = "Passwords do not match";
		
		    if ($password != null && $retypepassword != null && $userID != null){
		        if ($password == $retypepassword){
		            // $password = md5($password); LEGACY
		            $password = hash('ripemd256',$password);
		            $sqlconnect = new Connectdb;
		            $db = $sqlconnect->connectTo();
		            mysqli_query($db,"UPDATE users SET password='$password' WHERE id='$userID'");
		            $db->close();
		            header("location:logout.php");
		        }
		        else{
		            header("location:ChangePassword.php?id=$userID&error=$errorMessage2");
		        }
		    }
		    else {
		        header("location:ChangePassword.php?id=$userID&error=$errorMessage1");
		    }   
			
		}
		//=============================================================

		//=============================================================
		
		
		
		
		//=============================================================
		//   Change Avatar	
		//=============================================================
		elseif ($subType == 'changeAvatar'){
			
			$userID = $_POST['id'];
		    $avatar = $_POST['avatar'];
		    $errorMessage1 = "FATAL: No Image was passed through!";
		
		    if ($avatar != nulll){
		        $sqlconnect = new Connectdb;
		        $db = $sqlconnect->connectTo();
				if ($avatar == 'none'){
					mysqli_query($db,"UPDATE users SET profileimg='' WHERE id='$userID'");
				}else{
					mysqli_query($db,"UPDATE users SET profileimg='$avatar' WHERE id='$userID'");
				}
		        $db->close();
		        header("location:editUserDetails.php?id=$userID&msg=Avatar Successfully Updated!");
		    }
		    else {
		        header("location:ChangeUserAvatar.php?id=$userID&error=$errorMessage1");
		    }
			
		}
		//=============================================================

		//=============================================================
		
		
		
		//=============================================================
		//   Custom Page
		//=============================================================
		elseif ($subType == 'customPage'){
			
			$pagename = $_REQUEST['PageName'];
		    $link = $_REQUEST['PageLink'];
			$editlink = $_REQUEST['EditPageLink'];
		    
		    if ($pagename != null && $link != null){
		        $sqlconnect = new Connectdb;
		        $db = $sqlconnect->connectTo();
				if ($editlink != null | $editlink != ''){
					$SentToDatabase = "
					INSERT INTO pages (pagename, additional, pagetype, additional2)
					VALUES ('$pagename', '$link', 'relink', '$editlink')";
				}else{
					$SentToDatabase = "
					INSERT INTO pages (pagename, additional, pagetype)
					VALUES ('$pagename', '$link', 'relink')";
				}
		        
		        mysqli_query($db,$SentToDatabase);
		        $db->close();
		        header("location:controlpanel.php");
		    }else{
		        echo "No Page Name or Page Link Given";
		    }
			
		}
		//=============================================================

		//=============================================================
		
		
		
		
		//=============================================================
		//   Edit Category Submit	
		//=============================================================
		elseif ($subType == 'editCategory'){
			
			$categoryID = $_POST['id'];
		    $categoryName = $_POST['categoryName'];
			$categoryIcon = $_POST['icon'];
		
			if ($categoryIcon == null || $categoryIcon == 'none'){
				$sendToDatabase = "UPDATE categories SET category='$categoryName', icon='' WHERE id='$categoryID'";
			}else{
				$sendToDatabase = "UPDATE categories SET category='$categoryName', icon='$categoryIcon' WHERE id='$categoryID'";
			}
		    
		    $sqlconnect = new Connectdb;
		    $db = $sqlconnect->connectTo();
		    mysqli_query($db,$sendToDatabase);
		    $db->close();
		    header("location:controlpanel.php");
			
		}
		//=============================================================

		//=============================================================
		
		
		
		
		
		
		
		
		
		//=============================================================
		//   Edit Contact Page
		//=============================================================
		elseif ($subType == 'editContactPage'){
			
			$pageID = $_POST['id'];
			$getEmail = $_POST['email'];
			$getTitle = $_POST['title'];
			$getImage = $_POST['image'];
			$getContent = $_POST['contactbody'];
			
			if (isset($pageID)){
				$sendToDatabase = "
				UPDATE pages SET additional='$getEmail', pagename='$getTitle',
				bodycontent='$getContent', image='$getImage' WHERE id='$pageID'";
				$sqlconnect = new Connectdb;
				$db = $sqlconnect->connectTo();
				mysqli_query($db,$sendToDatabase);
				$db->close();
				header("location:controlpanel.php");
			}else{
				echo "Error: No ID Given";
			}
		}
		//=============================================================

		//=============================================================
		
		
		
		
		
		
		
		
		
		//=============================================================
		//   Edit Custom Page
		//=============================================================
		elseif ($subType == 'editCustomPage'){
			
			$pagename = $_POST['PageName'];
		    $link = $_POST['PageLink'];
			$editlink = $_POST['EditPageLink'];
		    $id = $_POST['id'];
		    
		    if ($pagename != null && $link != null && $id != null){
		    	
				if ($editlink != null || $editlink != ''){
					$sendToDatabase = "
					UPDATE pages SET pagename='$pagename', additional='$link',
					additional2='$editlink' WHERE id='$id'";
				}
				else{
					$sendToDatabase = "
					UPDATE pages SET pagename='$pagename', additional='$link'
					WHERE id='$id'";
				}
		        
		        $sqlconnect = new Connectdb;
		        $db = $sqlconnect->connectTo();
		        mysqli_query($db,$sendToDatabase);
		        $db->close();
		        header("location:controlpanel.php");
		    }else{
		        echo "ERROR: Please enter in details";
		    }
			
		}
		//=============================================================

		//=============================================================
		
		
		
		
		
		//=============================================================
		//   Edit Page
		//=============================================================
		elseif ($subType == 'editPage'){
            
            $sqlconnect = new Connectdb;
			$db = $sqlconnect->connectTo();
            
            $pageId = $_POST['id'];
			$pageTitle = $_POST['pagename'];
			$isDraft = $_POST['draft'];
            
            //Backup Old Page Data
            $sqlQuery = mysqli_query($db, "SELECT * FROM pages WHERE id='$pageId'");
            $fetchData = mysqli_fetch_assoc($sqlQuery);
            $contentArray = array();
            $contentArray['title'] = $fetchData['pagename'];
            $contentArray['body'] = $fetchData['bodycontent'];
            $peacock->storeToFile('view/backups/pages/pageBackup-'.$pageId.'.json',$contentArray, 'JSON');
            //=======================
            
            $getBodyContents = $_POST['pagecontent'];
			
            $draftContentArray = array();
            $draftContentArray['title'] = $pageTitle;
            $draftContentArray['body'] = $getBodyContents;
            
            if ($isDraft == 'yes'){
                $peacock->storeToFile('view/drafts/pages/pageDraft-'.$pageId.'.json',$draftContentArray, 'JSON');
                
                $sendToDatabase = "UPDATE pages SET draft='$isDraft' WHERE id='$pageId'";
                
            }else{
                $SQLBodyContents = addslashes($getBodyContents);
                $sendToDatabase = "UPDATE pages SET bodycontent='$SQLBodyContents', draft='$isDraft', pagename='$pageTitle' WHERE id='$pageId'";
            }
            
            mysqli_query($db,$sendToDatabase) or die(mysqli_error($db));
			$db->close();
			
			header("location:controlpanel.php");
		}
		//=============================================================

		//=============================================================
        
        
        
        
        
        
        //=============================================================
		//   Edit Page Source
		//=============================================================
		elseif ($subType == 'editPageSource'){
            
            $sqlconnect = new Connectdb;
			$db = $sqlconnect->connectTo();
            
            $pageId = $_REQUEST['id'];
            $getBodyContents = $_REQUEST['code'];
            $SQLBodyContents = addslashes($getBodyContents);
            $sendToDatabase = "UPDATE pages SET bodycontent='$SQLBodyContents' WHERE id='$pageId'";
            mysqli_query($db,$sendToDatabase) or die(mysqli_error($db));
			$db->close();		
			header("location:controlpanel.php");
		}
		//=============================================================

		//=============================================================
		
		
		
		
		
		//=============================================================
		//   Edit Post	
		//=============================================================
		elseif ($subType == 'editPost'){
            
            $postId = $_POST['id'];
			$getPostContents = $_POST['postcontent'];
            $SQLPostContents = addslashes($getPostContents);
			$postTitle = $_POST['postname'];
			$isDraft = $_POST['draft'];
			$postImage = $_POST['postimage']; 
            
            $sqlconnect = new Connectdb;
            $db = $sqlconnect->connectTo();
            
            //Backup Old Page Data
            $sqlQuery = mysqli_query($db, "SELECT * FROM blog WHERE id='$postId'");
            $fetchData = mysqli_fetch_assoc($sqlQuery);
            $contentArray = array();
            $contentArray['title'] = $fetchData['posttitle'];
            $contentArray['body'] = $fetchData['postcontent'];
            $peacock->storeToFile('view/backups/posts/postBackup-'.$postId.'.json',$contentArray,'JSON');
            //=======================
            

            $getPostContents = $_POST['postcontent'];

            
            $draftContentArray = array();
            $draftContentArray['title'] = $postTitle;
            $draftContentArray['body'] = $getPostContents;
            
            if ($isDraft == 'yes'){
                
                $peacock->storeToFile('view/drafts/posts/postDraft-'.$postId.'.json',$draftContentArray,'JSON');
                
                $sendToDatabase = "UPDATE blog SET draft='$isDraft' WHERE id='$postId'";
                
            }else{
                
                $date = date('Y-m-d H:i:s'); 
                if ($postImage != 'none'){
                    $sendToDatabase = "
                    UPDATE blog SET postcontent='$SQLPostContents', draft='$isDraft',
                    posttitle='$postTitle', date='$date', image='$postImage', status='active'
                    WHERE id='$postId'";
                }else{
                    $sendToDatabase = "
                    UPDATE blog SET postcontent='$SQLPostContents', draft='$isDraft',
                    posttitle='$postTitle', date='$date', image='', status='active
                    WHERE id='$postId'";
                }
            }
            
            mysqli_query($db,$sendToDatabase);
            $db->close();
            
			header("location:controlpanel.php");
			
		}
		//=============================================================

		//=============================================================
		
		
		
		
		
		
		//=============================================================
		//   Edit User
		//=============================================================
		elseif ($subType == 'editUser'){
			
			$userID = $_POST['id'];
		    $firstName = $_POST['firstname'];
		    $lastName = $_POST['lastname'];
		    $email = $_POST['email'];
		    $accType = $_POST['accounttype'];
		    $sendToDatabase = "
		    UPDATE users SET firstname='$firstName', lastname='$lastName',
		    email='$email', acctype='$accType' WHERE id='$userID'";
		
		    $errorMessage = "Don't leave any blank details";
		
		    if ($userID != null && $firstName != null && $lastName != null && $email != null){
		        $sqlconnect = new Connectdb;
		        $db = $sqlconnect->connectTo();
		        mysqli_query($db,$sendToDatabase);
		        $db->close();
		        header("location:editUserDetails.php?id=$userID&msg=Successfully Updated!");
		    }
		    else {
		        header("location:editUserDetails.php?id=$userID&msg=$errorMessage");
		    }
			
		}
		//=============================================================

		//=============================================================
		

		
		

        //=============================================================
		//   Create Template
		//=============================================================
		elseif ($subType == 'createTemplate'){

            $templateContent = $_POST['pagecontent'];			
			$templateName = $_POST['pagename'];
			$isDraft = $_POST['draft'];
			
			$sqlconnect = new Connectdb;
			$db = $sqlconnect->connectTo();
			
			if ($templateName && $templateContent){
                mysqli_query($db,"
                    INSERT INTO templates (templateName, templateContent, draft)
                    VALUES ('$templateName', '$templateContent', '$isDraft')");
				header("location:controlpanel.php");
            }
			else{
				echo "ERROR! No Pass of: ";
				
				if ($templateName == null){
					echo "pagename ";
				}
				elseif ($templateContent == null){
					echo "Body Content ";
				}
				elseif ($isDraft == null){
					echo "Didn't recieve if you wish to save as draft or final";
				}
			}    
            $db->close();
		}
		//=============================================================

		//=============================================================
        
        
        //=============================================================
		//   Edit Template
		//=============================================================
		elseif ($subType == 'editTemplate'){
            
            $templateID = $_POST['templateID'];
            $templateContent = $_POST['pagecontent'];			
			$templateName = $_POST['pagename'];
			$isDraft = $_POST['draft'];
			
			$sqlconnect = new Connectdb;
			$db = $sqlconnect->connectTo();
			
			if ($templateName && $templateContent && $templateID){
                mysqli_query($db,"UPDATE templates SET templateName='$templateName', templateContent='$templateContent', draft='$isDraft' WHERE id='$templateID'");
				header("location:controlpanel.php");
            }
			else{
				echo "ERROR! No Pass of: ";
				
				if ($templateName == null){
					echo "pagename ";
				}
				elseif ($templateContent == null){
					echo "Body Content ";
				}
				elseif ($isDraft == null){
					echo "Didn't recieve if you wish to save as draft or final";
				}
			}    
            $db->close();
		}
		//=============================================================

		//=============================================================
        
        
		
		
		//=============================================================
		//   Page Submit
		//=============================================================
		elseif ($subType == 'submitPage'){

            $bodycontent = $_POST['pagecontent'];
            $SQLbodycontent = addslashes($bodycontent);
			$pagename = $_POST['pagename'];
			$isDraft = $_POST['draft'];
			@$type = $_POST['pageType'];
			
			$date = date('Y-m-d H:i:s');
			
			$sqlconnect = new Connectdb;
			$db = $sqlconnect->connectTo();
			
			if ($pagename && $SQLbodycontent && $type == 'normal'){
                if ($isDraft == 'yes'){
                    mysqli_query($db,"
                    INSERT INTO pages (pagename, bodycontent, draft, date, status)
                    VALUES ('$pagename', '$SQLbodycontent', '$isDraft', '$date', 'draft')");
                }else{
                   mysqli_query($db,"
                    INSERT INTO pages (pagename, bodycontent, draft, date)
                    VALUES ('$pagename', '$SQLbodycontent', '$isDraft', '$date')"); 
                }
				header("location:controlpanel.php");
				}
			elseif ($pagename && $SQLbodycontent && $type == 'subpage'){
                if ($isDraft == 'yes'){
                    mysqli_query($db,"
                    INSERT INTO pages (pagename, bodycontent, draft, date, pagetype, status)
                    VALUES ('$pagename', '$SQLbodycontent', '$isDraft', '$date', '$type', 'draft')");
                }else{
                    mysqli_query($db,"
                    INSERT INTO pages (pagename, bodycontent, draft, date, pagetype)
                    VALUES ('$pagename', '$SQLbodycontent', '$isDraft', '$date', '$type')");
                }
				header("location:controlpanel.php");
			}
			else{
				echo "ERROR! No Pass of: ";
				
				if ($pagename == null){
					echo "pagename ";
				}
				elseif ($bodycontent == null){
					echo "Body Content ";
				}
				elseif ($isDraft == null){
					echo "Didn't recieve if you wish to save as draft or final";
				}
				elseif($type == null){
					echo "Page Type is not Specified";
				}
			}
            
            $pageID = mysqli_insert_id($db);
            
            $contentArray = array();
            $contentArray['title'] = $pagename;
            $contentArray['body'] = $bodycontent;
            $peacock->storeToFile('view/backups/pages/pageBackup-'.$pageID.'.json',$contentArray,'JSON');
            
            $db->close();
			
		}
		//=============================================================

		//=============================================================
		
		
		
		
		
		
		//=============================================================
		//   Rename Image	
		//=============================================================
		elseif ($subType == 'renameImage'){
			
			$imagename = $_POST['ImageName'];
		    $id = $_POST['id'];
			$folder = $_POST['folder'];
		    
		    if ($imagename != null){
		        $sendToDatabase = "UPDATE images SET imagename='$imagename' WHERE id='$id'";
		        $sqlconnect = new Connectdb;
		        $db = $sqlconnect->connectTo();
		        mysqli_query($db,$sendToDatabase);
		        $db->close();
				if ($folder != null){
					 header("location:viewImages.php?folder=$folder");
				}else{
					 header("location:controlpanel.php");
				}
		    }else{
		        header("location:RenameImage.php");
		    }
			
		}
		//=============================================================

		//=============================================================
		
		
		
		//=============================================================
		//   Site Description	
		//=============================================================
		elseif ($subType == 'siteDescription'){
			
			$sitedesc = $_POST['description'];

		    $sendToDatabase = "UPDATE site SET description='$sitedesc' WHERE id='1'";
		    $sqlconnect = new Connectdb;
		    $db = $sqlconnect->connectTo();
		    mysqli_query($db,$sendToDatabase);
		    $db->close();
		    header("location:controlpanel.php");
			
		}
		//=============================================================

		//=============================================================
		
		
		
		//=============================================================
		//   Site Name	
		//=============================================================
		elseif ($subType == 'siteName'){
			
			$sitename = $_REQUEST['sitename'];
		    $sqlconnect = new Connectdb;
		    $db = $sqlconnect->connectTo();
		    $sendToDatabase = "UPDATE site SET sitename='$sitename' WHERE id='1'";
		
		    mysqli_query($db,$sendToDatabase);
		    $db->close();
		    header("location:controlpanel.php");
			
		}
		//=============================================================

		//=============================================================
		
		
		//=============================================================
		//   Site Tags
		//=============================================================
		elseif ($subType == 'siteTags'){
			
			$sitetags = $_POST['tags'];

		    $sendToDatabase = "UPDATE site SET tags='$sitetags' WHERE id='1'";
		    $sqlconnect = new Connectdb;
		    $db = $sqlconnect->connectTo();
		    mysqli_query($db,$sendToDatabase);
		    $db->close();
		    header("location:controlpanel.php");
			
		}
		//=============================================================

		//=============================================================
		
		
		
		//=============================================================
		//   Site Theme
		//=============================================================
		elseif ($subType == 'siteTheme'){
			
			$sitetheme = $_POST['sitetheme'];
		    $sqlconnect = new Connectdb;
		    $db = $sqlconnect->connectTo();
		    $sendToDatabase = "UPDATE site SET theme='$sitetheme' WHERE id='1'";
		
		    mysqli_query($db,$sendToDatabase);

		    $themeContents = $_POST['importThemeContents'];

		    if ($themeContents == true){
		    	$SQLRW->readSQL(SITE_PATH."themes/".$sitetheme."/".$sitetheme.".sql");
		    }

		    $db->close();
		    header("location:controlpanel.php");

		}
		//=============================================================

		//=============================================================
		
		
		
		//=============================================================
		//   Create Image Folder	
		//=============================================================
		elseif ($subType == 'CreateImageFolder'){
				
			$folderName = $_POST['FolderName'];
			
			if ($peacock->checkImageFolderExist($folderName) == false){
				
				$sqlconnect = new Connectdb;
			    $db = $sqlconnect->connectTo();
			    $sendToDatabase = "INSERT INTO imageFolders (folderName)
					VALUES ('$folderName')";
			
			    mysqli_query($db,$sendToDatabase);
			    $db->close();
			    header("location:viewImageFolders.php");
					
			}

		}
		//=============================================================

		//=============================================================


		//=============================================================
		//   Rename Image Folder	
		//=============================================================
		elseif ($subType == 'RenameImageFolder'){
				
			$folderName = $_POST['FolderName'];
			$id = $_POST['id'];

			$oldFolder = $peacock->getFolderName($id);
		
				
			$sqlconnect = new Connectdb;
		    $db = $sqlconnect->connectTo();
		    $sendToDatabase = "UPDATE imageFolders SET folderName='".$folderName."' WHERE id='".$id."'";
		
		    mysqli_query($db,$sendToDatabase);

		    $FindData = mysqli_query($db,"SELECT * FROM images WHERE imageFolder='$oldFolder'");
					
			while ($get_data = mysqli_fetch_assoc($FindData)){
				if ($get_data['id'] != null){
					$ImageQuery = "UPDATE images SET imageFolder='$folderName' WHERE imageFolder='$oldFolder'";
					mysqli_query($db,$ImageQuery);
				}
			}
		    $db->close();
		    header("location:viewImageFolders.php");


		}
		//=============================================================

		//=============================================================
		
		
		
		
		//=============================================================
		//   Remove Image Folders	
		//=============================================================
		elseif ($subType == 'removeImageFolders'){
			
		    $sqlconnect = new Connectdb;
		    $db = $sqlconnect->connectTo();
			
			foreach($_REQUEST['folderlist'] as $folder){
				if ($folder != null){
					$sendToDatabase = "DELETE FROM imageFolders WHERE folderName='$folder'";
					mysqli_query($db,$sendToDatabase);
					
					$FindData = mysqli_query($db,"SELECT * FROM images WHERE imageFolder='$folder'");
					
					while ($get_data = mysqli_fetch_assoc($FindData)){
						if ($get_data['id'] != null){
							$RemoveImageQuery = "UPDATE images SET imageFolder='Uncategorised' WHERE id='".$get_data['id']."'";
							mysqli_query($db,$RemoveImageQuery);
						}
					}
					
				}
			}
		    $db->close();
		}
		//=============================================================

		//=============================================================
		
		
		//=============================================================
		//   Remove Image and Folders	
		//=============================================================
		elseif ($subType == 'removeImageAndFolders'){
			
		    $sqlconnect = new Connectdb;
		    $db = $sqlconnect->connectTo();
			
			foreach($_REQUEST['folderlist'] as $folder){
				if ($folder != null){
					$sendToDatabase = "DELETE FROM imageFolders WHERE folderName='$folder'";
					mysqli_query($db,$sendToDatabase);
					
					$FindData = mysqli_query($db,"SELECT * FROM images WHERE imageFolder='$folder'");
					
					while ($get_data = mysqli_fetch_assoc($FindData)){
						if ($get_data['id'] != null){
							$imageID = $get_data['id'];
						    $imagename = $get_data['image'];
						    $deletePath = "image/"+$imagename;
							unlink($deletePath);
						    mysqli_query($db,"DELETE FROM images WHERE id='$imageID'");
						}
					}
				}
			}
		    $db->close();
		}
		//=============================================================

		//=============================================================
		
		
		
		//=============================================================
		//   Arrange Image Folders
		//=============================================================
		elseif ($subType == 'arrangeImageFolders'){
			
			if (isset($_REQUEST['data'])){
	
				$data = $_REQUEST['data'];
				parse_str($data, $str);
				$menu = $str['item'];
				
				$sqlconnect = new Connectdb;
			    $db = $sqlconnect->connectTo();
				
				foreach ($menu as $key => $value){
					$key = $key + 1;
					$sendToDatabase = "UPDATE imageFolders SET folderOrder='$key' WHERE id='$value'";
					mysqli_query($db,$sendToDatabase);
				}
					
			    $db->close();
		   }
			
		}
		//=============================================================

		//=============================================================
		
		
		//=============================================================
		//   Arrange Images
		//=============================================================
		elseif ($subType == 'arrangeImages'){
			
			if (isset($_REQUEST['data'])){
	
				$data = $_REQUEST['data'];
				parse_str($data, $str);
				$menu = $str['item'];
				
				$sqlconnect = new Connectdb;
			    $db = $sqlconnect->connectTo();
				
				foreach ($menu as $key => $value){
					$key = $key + 1;
					$sendToDatabase = "UPDATE images SET imageOrder='$key' WHERE id='$value'";
					mysqli_query($db,$sendToDatabase);
				}
					
			    $db->close();
		   }
			
		}
		//=============================================================

		//=============================================================
		
		
		
		
		
		//=============================================================
		//   delete Images
		//=============================================================
		elseif ($subType == 'deleteImages'){
			
			$sqlconnect = new Connectdb;
		    $db = $sqlconnect->connectTo();
			
			foreach($_REQUEST['imagelist'] as $image){
				if ($image != null){
					$sendToDatabase = "DELETE FROM images WHERE id='$image'";
					$imagename = $peacock->getImageFilename($image);
					$deletePath = "image/"+$imagename;
					unlink($deletePath);
					mysqli_query($db,$sendToDatabase);
					
					$FindData = mysqli_query($db,"SELECT * FROM images WHERE imageFolder='$folder'");
				}
			}
		    $db->close();
			
		}
		//=============================================================

		//=============================================================
		
		
		
		
		//=============================================================
		//   Move Images
		//=============================================================
		elseif ($subType == 'moveImages'){
			
			$sqlconnect = new Connectdb;
		    $db = $sqlconnect->connectTo();
			
			$folder = $_REQUEST['folder'];
			
			foreach($_REQUEST['movelist'] as $image){
				if ($image != null){
					$sendToDatabase = "UPDATE images SET imageFolder='$folder' WHERE id='$image'";
					mysqli_query($db,$sendToDatabase);
				}
			}
		    $db->close();
			
		}
		//=============================================================

		//=============================================================




		//=============================================================
		//   Add Plugin
		//=============================================================
		elseif ($subType == 'addPlugin'){
			
			$plugin = $_REQUEST['pluginList'];

			if (isset($plugin)){

				$sqlconnect = new Connectdb;
		    	$db = $sqlconnect->connectTo();

				$sendToDatabase = "INSERT INTO plugins (pluginName) VALUES ('$plugin')";
				mysqli_query($db,$sendToDatabase);

			    $db->close();

			}

			header("location:controlpanel.php");
			
		}
		//=============================================================

		//=============================================================

		
		
		
		//=============================================================
		//   Show/Hide Site Image
		//=============================================================
		elseif ($subType == 'showHideSiteImage'){
			
			$showHide = $_REQUEST['useImage'];

			if (isset($showHide)){

				$sqlconnect = new Connectdb;
		    	$db = $sqlconnect->connectTo();

				$sendToDatabase = "UPDATE site SET useimage='$showHide' WHERE id='1'";
				mysqli_query($db,$sendToDatabase);

			    $db->close();

			}

		}
		//=============================================================

		//=============================================================
		
		
		//=============================================================
		//   Page Image
		//=============================================================
		elseif ($subType == 'setPageImage'){
            
            $pageID = $_POST['id'];
            $image = $_POST['pageimage'];
            
            if ($pageID != null && $image != null){
                $sqlconnect = new Connectdb;
                $db = $sqlconnect->connectTo();

                $sendToDatabase = "UPDATE pages SET image='$image' WHERE id='$pageID'";
                mysqli_query($db,$sendToDatabase);

                $db->close();
                header("location:controlpanel.php");
            }
			
		}
		//=============================================================

		//=============================================================
		
        
        
        //=============================================================
		//   Edit Footer	
		//=============================================================
		elseif ($subType == 'editFile'){
            
            $code = $_REQUEST['code'];
            $file = $_REQUEST['file'];

            if ($code != null && $file != null){
                if (file_exists($file)){
                    file_put_contents($file,$code);
                    return "Successfully Updated!";
                }else{
                    return "FILE DOES NOT EXIST";   
                }
            }else{
              return "NO DATA GIVEN";   
            }
			
		}
		//=============================================================

		//=============================================================
        
        
        
        
        
        //=============================================================
		//   Create Group	
		//=============================================================
		elseif ($subType == 'createGroup'){
			$groupName = $_REQUEST['GroupName'];
		    if ($groupName != null){
		        $sqlconnect = new Connectdb;
		        $db = $sqlconnect->connectTo();
				$SentToDatabase = "
				INSERT INTO pages (pagename, pagetype)
				VALUES ('$groupName', 'group')";  
		        mysqli_query($db,$SentToDatabase);
		        $db->close();
		        header("location:controlpanel.php");
		    }else{
		        echo "No Page Name or Page Link Given";
		    }
			
		}
		//=============================================================

		//=============================================================
        
        
        
        //=============================================================
		//   Add Page to Group
		//=============================================================
		elseif ($subType == 'addPageToGroup'){
			
			$pageID = $_REQUEST['PageID'];
            $groupID = $_REQUEST['GroupID'];
		    if ($pageID != null){
		        $sqlconnect = new Connectdb;
		        $db = $sqlconnect->connectTo();
				$SentToDatabase = "UPDATE pages SET groupID='$groupID', isGrouped='true' WHERE id='$pageID'";  
		        mysqli_query($db,$SentToDatabase);
		        $db->close();
		        header("location:controlpanel.php");
		    }else{
		        echo "No Page Name or Page Link Given";
		    }
			
		}
		//=============================================================

		//=============================================================
        
        
        
        
        
        //=============================================================
		//   Delete Group All
		//=============================================================
		elseif ($subType == 'DeleteGroupAll'){
			
            $groupID = $_REQUEST['GroupID'];
            
            $sqlconnect = new Connectdb;
            $db = $sqlconnect->connectTo();

            $sendToDatabase = "DELETE FROM pages WHERE id='$groupID'"; 
            mysqli_query($db,$sendToDatabase);
            $query = mysqli_query($db, "SELECT * FROM pages");
            while($get_data = mysqli_fetch_assoc($query)){
                if($get_data['groupID'] == $groupID){
                    $pageID = $get_data['id'];
                    mysqli_query($db,"DELETE FROM pages WHERE id='$pageID'");   
                }
            }
            header("location:controlpanel.php");
			$db->close();
		}
		//=============================================================

		//=============================================================
        
        
        
        //=============================================================
		//   Delete Group
		//=============================================================
		elseif ($subType == 'DeleteGroup'){
			
			$deleteAll = $_REQUEST['DeleteAll'];
            $groupID = $_REQUEST['GroupID'];
            
            $sqlconnect = new Connectdb;
            $db = $sqlconnect->connectTo();
            
            $sendToDatabase = "DELETE FROM pages WHERE id='$groupID'"; 
            mysqli_query($db,$sendToDatabase);
            $query = mysqli_query($db, "SELECT * FROM pages");
            while($get_data = mysqli_fetch_assoc($query)){
                if($get_data['groupID'] == $groupID){
                    $pageID = $get_data['id'];
                    mysqli_query($db,"UPDATE pages SET groupID='0', isGrouped='false' WHERE id='$pageID'");   
                }
            }
            header("location:controlpanel.php");
			$db->close();
		}
		//=============================================================

		//=============================================================
        
        
        
        //=============================================================
		//   Page Source Editing
		//=============================================================
		elseif ($subType == 'pageSourceEditing'){
			
			$sqlconnect = new Connectdb;
            $db = $sqlconnect->connectTo();
			
            $value = $_REQUEST['isChecked'];
            mysqli_query($db,"UPDATE site SET allowPageSource='$value' WHERE id='1'");
		}
		//=============================================================

		//=============================================================

		
		
		
/*		
		
		//=============================================================
		//   Name	
		//=============================================================
		elseif ($subType == ''){
			
			
			
		}
		//=============================================================

		//=============================================================
		
		
*/		
		
		
		
		
		
		else{
			echo "Submission is Unknown";
		}

	}else{
		echo "No Submission Type Given";
	}

?>