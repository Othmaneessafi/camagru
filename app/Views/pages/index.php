<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>

    <?php foreach($data['posts'] as $post) : ?>
        <div class="post-container  mb-3 shadow m-auto">
            <div class="d-flex justify-content-left h-auto mb-3 mx-2">
                <img class="post-user  shadow my-auto" src="<?php echo $post->profile_img ?>" alt="profile">
                <h4 class="card-title mx-2 my-auto h-auto" style="font-size: 1.5rem;"><?php echo $post->username; ?></h4>
            </div>
           
                <img class="post-img " src="<?php echo $post->content; ?>" alt="<?php echo $post->title; ?>">
           
            <div class="">
              <div class="">
                  <div class="d-flex flex-row mb-2">
                            <i class = "fa fa-heart-o"  onclick="like(event)" style="margin-top: 9px;margin-left:9px;">  
                            </i>
                          <strong><p id="li_nb_<?php echo $post->postId;?>" class="my-1"><?php echo $post->like_nbr;?> </p></strong>
                          <strong><p class="my-1 mx-1">Likes</p></strong>
                      </div>
                      </div>
                      <div class="comment" id="comment">
                        <?php
                          if(is_array($data['comments']))
                          {
                            foreach($data['comments'] as $comment)
                            {
                              if($comment->post_id == $post->postId)
                              {
                              ?>
                                  <ul class="media-list">
                                      <li class="media ">                    
                                          <div class="media-body">
                                              <strong class="text-dark mx-2"><?php echo $comment->username;?></strong>
                                              <small><p class="mx-4 text-muted"><?php echo htmlspecialchars($comment->content);?></p></small>
                                          </div>
                                      </li>
                                  </ul>
                                <?php
                              }
                            }
                          }?>
                        </div>
                        <div class="create_date mx-2">
                          <p><?php echo $post->create_at; ?></p>
                        </div>
                      <div class="">
                          <div class="input-group">
                            <input type="text" class="comment-input form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" name="comment_<?php echo $post->postId;?>" placeholder="write a comment...">
                            <div class="input-group-append">
                              <button onclick="comment(event)" class="post-btn btn btn-outline-primary" type="button">Post</button>
                            </div>
                          </div>
                      </div>
            </div>
        </div>
    <?php endforeach;  ?>
<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>