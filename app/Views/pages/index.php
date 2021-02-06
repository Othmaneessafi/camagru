<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>

    <?php foreach($data['posts'] as $post) : ?>
        <div class="post-container  mb-3 shadow m-auto">
            <div class="d-flex justify-content-left h-auto mb-3 mx-2">
                <img class="post-user  shadow my-auto" src="<?php echo $post->profile_img ?>" alt="profile">
                <h4 class="card-title mx-2 my-auto h-auto" style="font-size: 1.5rem;"><?php echo htmlspecialchars($_SESSION['user_username']); ?></h4>
            </div>
           
                <img class="post-img " src="<?php echo $post->content; ?>" alt="<?php echo $post->title; ?>">
           
            <div class="">
              <div class="">
                  <div class="d-flex flex-row mb-2">
                      <i class = "fa fa-heart-o"
                        data-post_id="<?php echo $post->postId; ?>" 
                        data-user_id="<?php if (isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>" 
                        data-like_nbr="<?php echo $post->like_nbr;?>" 
                        onclick="like(event)"
                        id="l_<?php echo $post->postId;?>"
                        name="li_<?php echo $post->postId;?>"
                        style="margin-top: 9px;margin-left:9px;">    
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
                                              <strong class="text-dark mx-2"><?php echo htmlspecialchars($comment->username); ?></strong>
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
                              <button onclick="comment(event)" 
                                data-c-user_id="<?php if (!empty($_SESSION['user_id'])) echo $_SESSION['user_id'];?>"
                                data-c-post_id="<?php echo $post->postId;?>"class="post-btn btn btn-outline-primary"
                                class="post-btn btn btn-outline-primary" type="button">Post</button>
                            </div>
                          </div>
                      </div>
            </div>
        </div>
    <?php endforeach;  ?>
        <div class="text-center">
            <ul class="pagination  justify-content-center ">
              <?php 
              if(($data['currentPage']-1) > 0)
                  echo '<li class="active"><a class="page-link" href="' . URL_ROOT . '/pages?page='.($data['currentPage']-1).'"><</a></li>';
              else
                  echo '<li class="active"><a class="page-link"><</a></li>';

              for($i = 1; $i <= $data['totalPages']; $i++){
                  if($i == $data['currentPage'])
                      echo '<li class="active"><a class="page-link">'.$i.'</a></li>';
                  else
                      echo '<li class="active"><a class="page-link" href="' . URL_ROOT . '/pages?page='.$i.'">'.$i.'</a></li>';
              }
              if(($data['currentPage']+1) <= $data['totalPages'])
                  echo '<li class="active"><a class="page-link" href="' . URL_ROOT . '/pages?page='.($data['currentPage']+1).'">></a></li>';
              else
                  echo '<li class="active""><a class="page-link">></a></li>';

              ?>
            </ul>
        </div>
<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>