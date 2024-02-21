<?php
// function renderComments($comments, $parent_id = null, $name = null)
// {
//     if ($comments->count() > 0) {
//         foreach ($comments as $item) {
//             if ($item->parent_id == $parent_id) {
//                 $class = $parent_id == null ? '' : 'comments__item--quote';
//                 echo '
//                 <li class="comments__item ' . $class . '">
//                     <div class="comments__autor">
//                         <img class="comments__avatar" src="' . asset('/client/img/user.svg') . '" alt="">
//                         <span class="comments__name">' . $item->customers->name . '</span>
//                         <span class="comments__time">' . $item->created_at . '</span>
//                     </div>
//                     <p class="comments__text">' . $name . " " . $item->content . '</p>
//                     <div class="comments__actions">
//                         <button type="button" data-id="' . $item->id . '"><i class="icon ion-ios-share-alt"></i>Phản hồi</button>
//                     </div>';
//                 renderComments($comments, $item->id, '<strong style="color: gold;">@' . $item->customers->name . '</strong>');
//                 echo '</li>';
//             }
//         }
//     }
// }
