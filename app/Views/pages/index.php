<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>

    <?php foreach($data['posts'] as $post) : ?>
        <div class="post-container card card-body mb-3 shadow m-auto">
            <div class="d-flex justify-content-left h-auto mb-3 mx-2">
                <img class="post-user  shadow my-auto" src="<?php echo $post->profile_img ?>" alt="profile">
                <h4 class="card-title mx-2 my-auto h-auto" style="font-size: 1.5rem;"><?php echo $post->username; ?></h4>
            </div>
            <div class="">
                <img class="post-img card-img-top" src="<?php echo $post->content; ?>" alt="<?php echo $post->title; ?>">
            </div>
            <div class="card-footer">
                      <?php
                        $liked = false;
                        foreach ($data['likes'] as $like) {
                            if ($like->user_id == $_SESSION['user_id'] && $like->post_id == $post->postId) {
                                $liked = true; ?>
                                <i class = "fa fa-heart"
                                   data-post_id="<?php echo $post->postId; ?>" 
                                   data-user_id="<?php echo $_SESSION['user_id']; ?>" 
                                   data-like_nbr="<?php echo $post->like_nbr;?>" 
                                  onclick="like(event)"
                                  id="l_<?php echo $post->postId;?>"
                                  name="li_<?php echo $post->postId;?>">    
                                </i>
                                <?php
                            }
                        }
                        if ($liked === false) {?>
                            <i class = "fa fa-heart-o"  
                              data-post_id="<?php echo $post->postId;?>" 
                              data-like_nbr="<?php echo $post->like_nbr;?>" 
                              data-user_id="<?php echo $_SESSION['user_id'];?>" 
                              onclick="like(event)" id="l_<?php echo $post->postId;?>"
                              name="li_<?php echo $post->postId;?>"> 
                            </i>
                        <?php }
                        ?>
                      <a id="li_nb_<?php echo $post->postId;?>" class="card-link text-muted"><?php echo $post->like_nbr;?></a>
              
                      <a class="card-link"><i class="fa fa-comment"></i> Comments</a>

                      <div class="cardbox-comments mt-2">
                          
                          <textarea name="comment_<?php echo $post->postId;?>" class="form-control w-100 mb-2" placeholder="write a comment..." rows="1" style="resize:none"></textarea>
                          <button onclick="comment(event)"
                            data-c-user_id="<?php echo $_SESSION['user_id'];?>"
                            data-c-post_id="<?php echo $post->postId;?>" class="btn btn-secondary pull-right">Add</button>
                        
                          <br>
                      </div>
                      <?php
                        if(is_array($data['comments']))
                        {
                          foreach($data['comments'] as $comment)
                          {
                            if($comment->post_id == $post->post_id)
                            {
                            ?>
                                <hr class="mb-1 mt-4">
                                <ul class="media-list">
                                    <li class="media">                    
                                        <div class="media-body">
                                            <strong class="text-dark">@<?php echo $comment->username;?></strong>
                                            <p><?php echo htmlspecialchars($comment->content);?></p>
                                        </div>
                                    </li>
                                </ul>
                              <?php
                            }
                          }
                        }?>
                      <div class="create_date mt-2">
                        <p><?php echo $post->create_at; ?></p>
                    </div>
            </div>
        </div>
    <?php endforeach;  ?>
<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>