<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 4/21/2019
 * Time: 9:50 PM
 */

namespace Noir;


class StarController extends Controller {
    /**
     * StarController constructor.
     * @param Site $site Site object
     * @param $user User object
     * @param array $post $_POST
     */
    public function __construct(Site $site, $user, $post) {
        parent::__construct($site);


        $id = strip_tags($post['id']);
        $rating = strip_tags($post['rating']);
        $homeview = new HomeView($site,$user);


        $movies = new Movies($site);

        if(!$movies->updateRating($user,$id, $rating)){
            $this->result = json_encode(['ok' => false, 'message'=>'Failed to update database!']);
            return;
        }

        $this->result = json_encode(['ok' => true, 'view'=>$homeview->presentTable()]);

    }



}