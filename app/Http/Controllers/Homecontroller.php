<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use App\Http\Requests;
use Redirect;
use App\Movie;
use App\Category;
use App\Options;
use App\RequestMov;

class Homecontroller extends Controller{

    public function index() {
        $title = 'Nonton Film Movie Online di Dewabioskop21.com';

        // if( $this -> checkip() == false ) {
        //     return view('errors/403');
        // }

        $allmoviedata = Movie::orderBy('year','desc') -> where('category','NOT LIKE','%Coming Soon%') -> orderBy('id','desc') -> paginate(18);
        $allmoviedatafeatured = Movie::where('featured','1') -> where('category','NOT LIKE','%Coming Soon%') -> orderBy('featured_position','desc') -> take(8) -> get();
        $allnewuploadmovie = Movie::where('category','NOT LIKE','%Coming Soon%') -> orderBy('id','desc') -> take(8) -> get();
        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        $data = ['title' => $title, 'moviedata' => $allmoviedata, 'moviedatafeatured' => $allmoviedatafeatured, 'newuploadmovie' => $allnewuploadmovie, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                return view('layout/mobile/home') -> with($data);
            }

        return view('layout/home') -> with($data);
    }

    public function allmoviemobile() {
        $title = 'Nonton Film Movie Online di Dewabioskop21.com';

        // if( $this -> checkip() == false ) {
        //     return view('errors/403');
        // }

        $allmoviedata = Movie::orderBy('year','desc') -> where('category','NOT LIKE','%Coming Soon%') -> orderBy('id','desc') -> paginate(15);

        $data = ['title' => $title, 'moviedata' => $allmoviedata];

        $useragent=$_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                return view('layout/mobile/allmovie') -> with($data);
            }
        else
            {
                return Redirect::to('/');
            }
    }

    public function single($slug_id, Request $req) {
        // if( $this -> checkip() == false ) {
        //     return view('errors/403');
        // }

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        $singlemovie = Movie::where('slug_id',$slug_id) -> first();

        if( count($singlemovie) == 0 )
            {
                return view('errors/404');
            }

        $title = 'Nonton ' . $singlemovie -> title . ' Subtitle Indonesia Dewabioskop21.com';
        $meta_desc = 'Nonton ' . $singlemovie->title . ' Movie Online Subtitle Indonesia Gratis Download Terbaru - Dewabioskop21.com';
        $cat_arr = explode(',', $singlemovie->category);

        if( count($cat_arr) >= 2 )
            {
                $genre_1 = $cat_arr[0];
                $genre_2 = $cat_arr[1];

                $allrelatedmovie = Movie::where('category','LIKE','%' . $genre_1 . '%') -> where('category','NOT LIKE','%Coming Soon%');
                $allrelatedmovie = $allrelatedmovie -> where('category','LIKE','%' . $genre_2 . '%') -> orderBy('year','desc') -> orderBy('id','desc') -> take(5) -> get();
            }
        else
            {
                $genre_1 = $cat_arr[0];
                
                $allrelatedmovie = Movie::where('category','LIKE','%' . $genre_1 . '%') -> where('category','NOT LIKE','%Coming Soon%') -> orderBy('year','desc') -> orderBy('id','desc') -> take(5) -> get();
            }

        foreach ($cat_arr as $item) 
            {
                if( $item == 'Best Movie' OR $item == 'Coming Soon' ) {
                    //Nothing
                } else {
                    $cat = Category::where('name', $item) -> first();

                    if( $cat  ) {
                        $cat -> viewer = $cat -> viewer + 1;
                        $cat -> save();        
                    }
                }
            }

        $link1 = $singlemovie -> gdrive_link;
        $link2 = $singlemovie -> photo_google_link;
        $crypt_salt = 'd0a7e7997b6d5fcd55f4b5c32611b87c';
        $view = $singlemovie -> view;
        $singlemovie -> view = $view + 1;
        $singlemovie -> save();

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if( $link1 == '' AND $link2 == '' )
            {
                $msg = "<p class='note'>Movie Error, back later</p>";

                $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial, 'msg' => $msg]; 

                if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                    {
                        return view('layout/mobile/single') -> with($data);
                    }

                return view('layout/single') -> with($data);
            }

        if( $link1 != '' )
            {
                if (filter_var($link1, FILTER_VALIDATE_URL) === FALSE) 
                    {
                        $resdrive = [];
                    }
                else
                    {
                        // $resdrive = $this -> getsourcedrive($link1);
                        // $resdrive = $this -> newcurl($link1) -> result -> data -> link;
                        $resdrive = $this -> newcurl($link1);
                    }
            }
        else
            {
                $resdrive = [];
            }    

        if( array_key_exists('37', $resdrive) )
            {
                $check_file = @get_headers($resdrive['37'], 1);

                if( $check_file[0] != 'HTTP/1.0 302 Found' AND $check_file[0] != 'HTTP/1.1 302 Found' )
                    {
                        unset($resdrive['37']);
                    }
                else
                    {
                        $mov_auth_key = $this -> mc_encrypt($resdrive['37'], $crypt_salt);
                        $auth_page = 'http://auth.dewabioskop21.com/authmovie.php?auth=' . $mov_auth_key;

                        $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_page' => $auth_page, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial]; 

                        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                            {
                                $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_label' => '1080p', 'link_page' => $resdrive['37'], 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial]; 

                                return view('layout/mobile/single') -> with($data);
                            }

                        return view('layout/single') -> with($data);
                    }
            }

        if( array_key_exists('22', $resdrive) )
            {
                $check_file = @get_headers($resdrive['22'], 1);

                if( $check_file[0] != 'HTTP/1.0 302 Found' AND $check_file[0] != 'HTTP/1.1 302 Found' )
                    {
                        unset($resdrive['22']);
                    }
                else
                    {
                        $mov_auth_key = $this -> mc_encrypt($resdrive['22'], $crypt_salt);
                        $auth_page = 'http://auth.dewabioskop21.com/authmovie.php?auth=' . $mov_auth_key;

                        $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_page' => $auth_page, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial]; 

                        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                            {
                                $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_label' => '720p', 'link_page' => $resdrive['22'], 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial]; 

                                return view('layout/mobile/single') -> with($data);
                            }

                        return view('layout/single') -> with($data);
                    }
            }

        if( array_key_exists('18', $resdrive) )
            {
                $check_file = @get_headers($resdrive['18'], 1);

                if( $check_file[0] != 'HTTP/1.0 302 Found' AND $check_file[0] != 'HTTP/1.1 302 Found' )
                    {
                        unset($resdrive['18']);
                    }
                else
                    {
                        $mov_auth_key = $this -> mc_encrypt($resdrive['18'], $crypt_salt);
                        $auth_page = 'http://auth.dewabioskop21.com/authmovie.php?auth=' . $mov_auth_key;

                        $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_page' => $auth_page, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial]; 

                        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                            {
                                $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_label' => '360p', 'link_page' => $resdrive['18'], 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial]; 

                                return view('layout/mobile/single') -> with($data);
                            }

                        return view('layout/single') -> with($data);
                    }
            }
        
        if( $link2 != '' )
            {
               $res = $this -> getPhotoGoogle($link2);
            }
        else
            {
                $res = [];
            }

        if(  array_key_exists('1080p', $res) )
            {
                $check_file = get_headers($res['1080p'], 1);

                if( $check_file[0] != 'HTTP/1.0 302 Found' AND $check_file[0] != 'HTTP/1.1 302 Found' )
                    {
                        unset($res['1080p']);
                    }
                else
                    {
                        $mov_auth_key = $this -> mc_encrypt($res['1080p'], $crypt_salt);
                        $auth_page = 'http://auth.dewabioskop21.com/authmovie.php?auth=' . $mov_auth_key;

                        $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_page' => $auth_page, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial]; 

                        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                            {
                                $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_label' => '1080p', 'link_page' => $res['1080p'], 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial]; 

                                return view('layout/mobile/single') -> with($data);
                            }

                        return view('layout/single') -> with($data);
                    }
            }

        if(  array_key_exists('720p', $res) )
            {
                $check_file = get_headers($res['720p'], 1);

                if( $check_file[0] != 'HTTP/1.0 302 Found' AND $check_file[0] != 'HTTP/1.1 302 Found' )
                    {
                        unset($res['720p']);
                    }
                else
                    {
                        $mov_auth_key = $this -> mc_encrypt($res['720p'], $crypt_salt);
                        $auth_page = 'http://auth.dewabioskop21.com/authmovie.php?auth=' . $mov_auth_key;

                        $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_page' => $auth_page, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial]; 

                        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                            {
                                $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_label' => '720p', 'link_page' => $res['720p'], 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial]; 

                                return view('layout/mobile/single') -> with($data);
                            }

                        return view('layout/single') -> with($data);
                    }
            }

        if(  array_key_exists('360p', $res) )
            {
                $check_file = get_headers($res['360p'], 1);

                if( $check_file[0] != 'HTTP/1.0 302 Found' AND $check_file[0] != 'HTTP/1.1 302 Found' )
                    {
                        unset($res['360p']);
                    }
                else
                    {
                        $mov_auth_key = $this -> mc_encrypt($res['360p'], $crypt_salt);
                        $auth_page = 'http://auth.dewabioskop21.com/authmovie.php?auth=' . $mov_auth_key;

                        $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_page' => $auth_page, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

                        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                            {
                                $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'link_label' => '360p', 'link_page' => $res['360p'], 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

                                return view('layout/mobile/single') -> with($data);
                            }

                        return view('layout/single') -> with($data);
                    }
            }

        $msg = "<p class='note'>Movie Error, back later</p>";

        $data = ['title' => $title, 'meta_desc' => $meta_desc, 'singlemovie' => $singlemovie, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'relatedmovie' => $allrelatedmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial, 'msg' => $msg]; 

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                return view('layout/mobile/single') -> with($data);
            }

        return view('layout/single') -> with($data);
    }

    public function featuredmovie() {
        if( $this -> checkip() == false ) {
            return view('errors/403');
        }

        $title = 'Nonton Film Pilihan - Dewabioskop21.com ';
        $section_title = 'All Featured Movie ';

        $allmoviedata = Movie::where('featured','1') -> where('category','NOT LIKE','%Coming Soon%') -> orderBy('year','desc') -> orderBy('id','desc') -> paginate(18);
        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();  

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        $count_res = count($allmoviedata);     

        if( $count_res <= 0 )
            {
                $msg = "<p class='note'>No Result</p>";

                $data = ['title' => $title, 'section_title' => $section_title, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial, 'msg' => $msg];                

                return view('layout/movie') -> with($data);
            } 

        $data = ['title' => $title, 'section_title' => $section_title, 'moviedata' => $allmoviedata, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

        return view('layout/movie') -> with($data);
    }

    public function latestuploadmovie() {
        if( $this -> checkip() == false ) {
            return view('errors/403');
        }

        $title = 'Nonton Film Baru Diupload - Dewabioskop21.com ';
        $section_title = 'All Latest Uploads Movie ';

        $allmoviedata = Movie::where('category','NOT LIKE','%Coming Soon%') -> orderBy('id','desc') -> paginate(18);
        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();  

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        $count_res = count($allmoviedata);     

        if( $count_res <= 0 )
            {
                $msg = "<p class='note'>No Result</p>";

                $data = ['title' => $title, 'section_title' => $section_title, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial, 'msg' => $msg];                

                return view('layout/movie') -> with($data);
            } 

        $data = ['title' => $title, 'section_title' => $section_title, 'moviedata' => $allmoviedata, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

        return view('layout/movie') -> with($data);
    }

    public function genremovie($genre) {
        if( $this -> checkip() == false )
            {
                return view('errors/403');
            }

        $meta_desc = 'Nonton Film ' . ucfirst($genre) . ' Online Subtitle Indonesia Gratis Download Terbaru - Dewabioskop21.com';
        $title = 'Nonton Film ' . ucfirst($genre) . ' - Dewabioskop21.com ';
        $section_title = 'All ' . ucfirst($genre) . ' Movie ';
        $check_cat = Category::where('name',$genre) -> get();

        if( count($check_cat) == 0 )
            {
                return view('errors/404');
            }

        $allmoviedata = Movie::where('category','LIKE','%' . $genre . '%') -> where('category','NOT LIKE','%Coming Soon%') -> orderBy('year','desc') -> orderBy('id','desc') -> paginate(18);
        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        $count_res = count($allmoviedata);

        $useragent=$_SERVER['HTTP_USER_AGENT'];

        if( $count_res <= 0 )
            {
                $msg = "<p class='note'>No Result</p>";

                $data = ['title' => $title, 'meta_desc' => $meta_desc, 'section_title' => $section_title, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial, 'msg' => $msg];                

                if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                    {
                        return view('layout/mobile/movie') -> with($data);
                    }

                return view('layout/movie') -> with($data);
            }

        $data = ['title' => $title, 'meta_desc' => $meta_desc, 'section_title' => $section_title, 'moviedata' => $allmoviedata, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                return view('layout/mobile/movie') -> with($data);
            }

        return view('layout/movie') -> with($data);
    }

    public function countrymovie($country) {

        if( $this -> checkip() == false )
            {
                return view('errors/403');
            }

        $meta_desc = 'Nonton Film ' . ucfirst($country) . ' Online Subtitle Indonesia Gratis Download Terbaru - Dewabioskop21.com';
        $title = 'Nonton Film ' . ucfirst($country) . ' - Dewabioskop21.com ';
        $section_title = 'All ' . ucfirst($country) . ' Movie ';

        $allmoviedata = Movie::where('country','LIKE','%' . $country . '%') -> where('category','NOT LIKE','%Coming Soon%') -> orderBy('year','desc') -> paginate(15);
        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        $count_res = count($allmoviedata);

        $useragent=$_SERVER['HTTP_USER_AGENT'];

        if( $count_res <= 0 )
            {
                $msg = "<p class='note'>No Result</p>";

                $data = ['title' => $title, 'meta_desc' => $meta_desc, 'section_title' => $section_title, 'bestmovie' => $allbestmovie, 'topcategories' => $alltopcategories, 'comingsoonmovie' => $allcomingsoonmovie, 'social' => $allsocial, 'msg' => $msg];

                if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                    {
                        return view('layout/mobile/movie') -> with($data);
                    }

                return view('layout/movie') -> with($data);
            }

        $data = ['title' => $title, 'meta_desc' => $meta_desc, 'section_title' => $section_title, 'moviedata' => $allmoviedata, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                return view('layout/mobile/movie') -> with($data);
            }

        return view('layout/movie') -> with($data);
    }

    public function yearmovie($year) {

        if( $this -> checkip() == false )
            {
                return view('errors/403');
            }

        $meta_desc = 'Nonton Film Tahun ' . ucfirst($year) . ' Online Subtitle Indonesia Gratis Download Terbaru - Dewabioskop21.com';
        $title = 'Nonton Film Tahun ' . $year . ' - Dewabioskop21.com ';
        $section_title = ' All Movie in ' . $year;

        $allmoviedata = Movie::where('year',$year) -> where('category','NOT LIKE','%Coming Soon%') -> orderBy('id','desc') -> paginate(15);
        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        $count_res = count($allmoviedata);

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if( $count_res <= 0 )
            {
                $msg = "<p class='note'>No Result</p>";

                $data = ['title' => $title, 'meta_desc' => $meta_desc, 'section_title' => $section_title, 'bestmovie' => $allbestmovie, 'topcategories' => $alltopcategories, 'comingsoonmovie' => $allcomingsoonmovie, 'social' => $allsocial, 'msg' => $msg];

                if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                    {
                        return view('layout/mobile/movie') -> with($data);
                    }

                return view('layout/movie') -> with($data);
            }

        $data = ['title' => $title, 'meta_desc' => $meta_desc, 'section_title' => $section_title, 'moviedata' => $allmoviedata, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                return view('layout/mobile/movie') -> with($data);
            }

        return view('layout/movie') -> with($data);
    }

    public function popularmovie() {
        if( $this -> checkip() == false ) {
            return view('errors/403');
        }

        $title = ' Nonton Film Terpopuler - Dewabioskop21.com ';
        $section_title = ' All Popular Movie ';

        $allmoviedata = Movie::where('category','NOT LIKE','%Coming Soon%') -> orderBy('view','desc') -> paginate(18);
        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        $data = ['title' => $title, 'section_title' => $section_title, 'moviedata' => $allmoviedata, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                return view('layout/mobile/movie') -> with($data);
            }

        return view('layout/movie') -> with($data);   
    }

    public function ratingmovie() {
        if( $this -> checkip() == false ) {
            return view('errors/403');
        }

        $title = ' Nonton Film Berdasarkan Rating Tertinggi - Dewabioskop21.com ';
        $section_title = ' All Movie Based On IMDB Rating ';

        $allmoviedata = Movie::where('category','NOT LIKE','%Coming Soon%') -> orderBy('rating','desc') -> paginate(18);
        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        $data = ['title' => $title, 'section_title' => $section_title, 'moviedata' => $allmoviedata, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                return view('layout/mobile/movie') -> with($data);
            }

        return view('layout/movie') -> with($data);   
    }

    public function searchmovie(Request $req) {
        if( $this -> checkip() == false ) {
            return view('errors/403');
        }

        $title = 'Nonton Film Berdasarkan Pencarian - Dewabioskop21.com';

        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();
        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        if( $req -> get('search') )
            {
                $allmoviedata = Movie::where('title','LIKE','%' . $req->get('search') . '%') -> where('category','NOT LIKE','%Coming Soon%') -> orderBy('year','desc') -> paginate(20);

                if( count($allmoviedata) != 0 )
                    {
                        $data = ['title' => $title, 'moviedata' => $allmoviedata, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];
                    }
                else
                    {
                        $msg = "<p class='note'>No Results</p>";
                        $data = ['title' => $title, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial, 'msg' => $msg];
                    }
            }
        else
            {

                $msg = "<p class='note'>No Results</p>";

                $data = ['title' => $title, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial, 'msg' => $msg];
            }

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                return view('layout/mobile/movie') -> with($data);
            }

        return view('layout/search') -> with($data);
    }

    public function filtermovie(Request $req) {
        if( $this -> checkip() == false ) {
            return view('errors/403');
        }

        $title = 'Nonton Film Movie Online di Dewabioskop21.com';

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                $data = [ 'title' => $title ];
                return view('layout/mobile/filter') -> with($data);
            }

        $order = $req -> input('order');
        $genre_1 = $req -> input('genre_1');
        $genre_2 = $req -> input('genre_2');
        $country = $req -> input('country');
        $year = $req -> input('year');

        if( $genre_1 != '' )
            {
                $movie = Movie::where('category','LIKE','%' . $genre_1 . '%') -> where('category','NOT LIKE','%Coming Soon%');
            }

        if( $genre_2 != '' )
            {
                if( $genre_1 == '' )
                    {
                        $movie = Movie::where('category','LIKE','%' . $genre_2 . '%') -> where('category','NOT LIKE','%Coming Soon%');      
                    }
                else
                    {
                        $movie = $movie -> where('category','LIKE','%' . $genre_2 . '%');
                    }
            }

        if( $country != '' )
            {       
                if( $genre_2 == '' AND $genre_1 == '' )
                    {
                        $movie = Movie::where('country','LIKE','%' . $country . '%') -> where('category','NOT LIKE','%Coming Soon%');                       
                    }
                else
                    {
                        $movie = $movie -> where('country','LIKE','%' . $country . '%');
                    }
            }

        if( $year != '' )
            {
                if( $genre_2 == '' AND $genre_1 == '' AND $country == '' )
                    {
                        $movie = Movie::where('year',$year) -> where('category','NOT LIKE','%Coming Soon%');
                    }
                else
                    {
                        $movie = $movie -> where('year',$year);
                    }
            }

        if( $order != '' )
            {
                if( $genre_2 == '' AND $genre_1 == '' AND $country == '' AND $year == '')
                    {
                        $movie = Movie::where('category','NOT LIKE','%Coming Soon%') -> orderBy('title',$order);
                        
                    }
                else
                    {
                        $movie = $movie -> orderBy('title',$order);
                    }
            }

        $movie = $movie -> paginate(18);
        $movie->setPath('filter?order=' . $order . '&genre_1=' . $genre_1 . '&genre_2=' . $genre_2 . '&country=' . $country . '&year=' . $year);

        $count_res = count($movie);
        $allmoviedata = $movie;
        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();
        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];


        if( $count_res <= 0 )
            {
                $msg = "<p class='note'>No Result</p>";

                $data = ['title' => $title, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial, 'msg' => $msg];

                return view('layout/movie') -> with($data);
            }

        $data = ['title' => $title, 'moviedata' => $allmoviedata, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

        return view('layout/movie') -> with($data);
    }

    public function dmcapage() {

        if( $this -> checkip() == false )
            {
                return view('errors/403');
            }
        
        $title = 'Digital Millennium Copyright Act(DMCA) - Dewabioskop21.com';

        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        $data = ['title' => $title, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

        return view('layout/dmca') -> with($data);
    }

    public function requestpage() {

        if( $this -> checkip() == false )
            {
                return view('errors/403');
            }

        $title = 'Request Film - Dewabioskop21.com';

        $allbestmovie = Movie::where('category','LIKE','%Best Movie%') -> where('category','NOT LIKE','%Coming Soon%') -> get();
        $allcomingsoonmovie = Movie::where('category','LIKE','%Coming Soon Selected%') -> get();
        $alltopcategories = Category::orderBy('viewer','desc') -> take(11) -> get();

        $social_fb = Options::where('item','facebook') -> first();
        $social_twitter = Options::where('item','twitter') -> first();
        $allsocial = [ 'facebook' => $social_fb, 'twitter' => $social_twitter ];

        $data = ['title' => $title, 'bestmovie' => $allbestmovie, 'comingsoonmovie' => $allcomingsoonmovie, 'topcategories' => $alltopcategories, 'social' => $allsocial];

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                $data = [ 'title' => $title ];
                return view('layout/mobile/request') -> with($data);
            }

        return view('layout/request') -> with($data);
    }

    public function storerequest(Request $req) {

        $the_request = $req -> input('movie-req');

        if( $the_request == '' )
            {
                $msg = "<p class='note'>Movie title can't be empty. </p>";
                return Redirect::to('/request') -> with('msg', $msg);
            }

        $requestmov = new RequestMov();

        $requestmov -> value = $the_request;

        $requestmov->save();

        $msg = "<p class='note'>Request has been sent. </p>";

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                return Redirect::to('/request') -> with('msg', $msg);
            }

        return Redirect::to('/request') -> with('msg', $msg);
    }

    public function filteringmoviemobile(Request $req) {

        $title = 'Nonton Film Movie Online di Dewabioskop21.com';

        $order = $req -> input('order');
        $genre_1 = $req -> input('genre_1');
        $genre_2 = $req -> input('genre_2');
        $country = $req -> input('country');
        $year = $req -> input('year');

        if( $genre_1 != '' )
            {
                $movie = Movie::where('category','LIKE','%' . $genre_1 . '%') -> where('category','NOT LIKE','%Coming Soon%');
            }

        if( $genre_2 != '' )
            {
                if( $genre_1 == '' )
                    {
                        $movie = Movie::where('category','LIKE','%' . $genre_2 . '%') -> where('category','NOT LIKE','%Coming Soon%');      
                    }
                else
                    {
                        $movie = $movie -> where('category','LIKE','%' . $genre_2 . '%');
                    }
            }

        if( $country != '' )
            {       
                if( $genre_2 == '' AND $genre_1 == '' )
                    {
                        $movie = Movie::where('country','LIKE','%' . $country . '%') -> where('category','NOT LIKE','%Coming Soon%');                       
                    }
                else
                    {
                        $movie = $movie -> where('country','LIKE','%' . $country . '%');
                    }
            }

        if( $year != '' )
            {
                if( $genre_2 == '' AND $genre_1 == '' AND $country == '' )
                    {
                        $movie = Movie::where('year',$year) -> where('category','NOT LIKE','%Coming Soon%');
                    }
                else
                    {
                        $movie = $movie -> where('year',$year);
                    }
            }

        if( $order != '' )
            {
                if( $genre_2 == '' AND $genre_1 == '' AND $country == '' AND $year == '')
                    {
                        $movie = Movie::where('category','NOT LIKE','%Coming Soon%') -> orderBy('title',$order);
                        
                    }
                else
                    {
                        $movie = $movie -> orderBy('title',$order);
                    }
            }

        $movie = $movie -> paginate(15);
        $movie->setPath('filter_mobile?order=' . $order . '&genre_1=' . $genre_1 . '&genre_2=' . $genre_2 . '&country=' . $country . '&year=' . $year);

        $count_res = count($movie);
        $allmoviedata = $movie;

        if( $count_res <= 0 )
            {
                $msg = "<p class='note'>No Result</p>";

                $data = ['title' => $title, 'msg' => $msg];

                return view('layout/mobile/movie') -> with($data);
            }

        $data = ['title' => $title, 'moviedata' => $allmoviedata ];

        return view('layout/mobile/movie') -> with($data);
    }

    public function getgeoip() {

        include(app_path() . '/../includes/geoip.inc');

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
            {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } 
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
            {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } 
        else 
            {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

        $GeoIPDatabase = geoip_open(app_path() . '/../includes/geoip.dat', GEOIP_STANDARD);
        $data['code'] = geoip_country_code_by_addr($GeoIPDatabase, $ip);
        $data['name'] = geoip_country_name_by_addr($GeoIPDatabase, $ip);
        geoip_close($GeoIPDatabase);

        return $data;
    }

    public function checkip() {

        $geo = $this -> getgeoip();

        $codeWhiteList = ['ID','PH','TH','VN','SG','MY','KH','MM','LA','BN','TL','JP','TW','HK','SA','AT'];
        $countryWhiteList = ['Indonesia','Philippines','Thailand','Vietnam','Singapore','Malaysia','Cambodia','Myanmar',"Lao People's Democratic Republic","Brunei Darussalam","Timor-Leste","Japan","Taiwan","Hong Kong","South Africa","Austria"];

        if( !in_array($geo['code'], $codeWhiteList) || !in_array($geo['name'], $countryWhiteList) ) {
            return false;
        } else {
            return true;
        }
    }

    public function sitemapgenerate(){
        $scriptXml = "";
        $countryList = ["Australia","China","Japan","USA","Canada","Thailand","Hong Kong","France","Germany","India","United","Italy","Korea","Malaysia","Mexico","Philiphines","Romania","Russia","Taiwan"];
        $yearStart = 1997;
        $yearEnd = 2016;
        $movie = Movie::all();
        $category = Category::all();

        foreach ($movie as $item) {
            $data[] = array(
                "slug" => trim($item->slug_id),
                "time" => str_replace(" ", "T", $item->updated_at)
            );
        }

        $dateNow = date("Y-m-d h:i:s");
        $handle = fopen('sitemap.xml', "w");
        fwrite($handle, "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'>");

        $scriptXml = "
        <url><loc>http://dwa21.com/genre/rating</loc>
        <lastmod>" . str_replace(" ", "T", $dateNow) . "+06:00</lastmod>
        <changefreq>daily</changefreq></url>

        <url><loc>http://dwa21.com/genre/popular</loc>
        <lastmod>" . str_replace(" ", "T", $dateNow) . "+06:00</lastmod>
        <changefreq>daily</changefreq></url>
        ";

        foreach ($countryList as $item) {
            $scriptXml .= "
            <url><loc>http://dwa21.com/country/" . urlencode($item) . "</loc>
            <lastmod>" . str_replace(" ", "T", $dateNow) . "+06:00</lastmod>
            <changefreq>daily</changefreq></url>
            ";
        }

        while( $yearStart <= $yearEnd ) {
            $scriptXml .= "
            <url><loc>http://dwa21.com/year/" . urlencode($yearStart) . "</loc>
            <lastmod>" . str_replace(" ", "T", $dateNow) . "+06:00</lastmod>
            <changefreq>daily</changefreq></url>
            ";
            $yearStart++;
        }

        foreach ($category as $item) {
            $scriptXml .= "
            <url><loc>http://dwa21.com/genre/" . urlencode(strtolower($item['name'])) . "</loc>
            <lastmod>" . str_replace(" ", "T", $item->updated_at) . "+06:00</lastmod>
            <changefreq>daily</changefreq></url>
            ";
        }

        foreach ($data as $item) {
            $scriptXml .= "
            <url><loc>http://dwa21.com/film/" . $item['slug'] . "</loc>
            <lastmod>" . $item['time'] . "+06:00</lastmod>
            <changefreq>daily</changefreq></url>
            ";
        }

        fwrite($handle, $scriptXml);

        // foreach ($data as $item) {
        //     fwrite($handle, "<url><loc>http://dwa21.com/film/" . $item['slug'] . "</loc>");
        //     fwrite($handle, "<lastmod>" . $item['time'] . "+06:00</lastmod>");
        //     fwrite($handle, "<changefreq>daily</changefreq></url>");
        // }

        fwrite($handle, "</urlset>");
        fclose($handle);

        return "Success Created XML";
    }

    public function getPhotoGoogle($link){
        $get = $this -> curl($link);
        $data = explode('url\u003d', $get);        
        
        if( isset($data[1]) )
            {
              $url = explode('%3Dm', $data[1]);
            }
        else
            {
                $linkDownload[] = '';

                return $linkDownload;
            }

        $decode = urldecode($url[0]);
        $count = count($data);
        $linkDownload = array();
        if ($count > 4) {
            $v1080p = $decode . '=m37';
            $v720p = $decode . '=m22';
            $v360p = $decode . '=m18';
            $linkDownload['1080p'] = $v1080p;
            $linkDownload['720p'] = $v720p;
            $linkDownload['360p'] = $v360p;
        }

        if ($count > 3) {
            $v720p = $decode . '=m22';
            $v360p = $decode . '=m18';
            $linkDownload['720p'] = $v720p;
            $linkDownload['360p'] = $v360p;
        }

        if ($count >= 2) {
            $v360p = $decode . '=m18';
            $linkDownload['360p'] = $v360p;
        }

        return $linkDownload;
    }

    public function getsourcedrive($link) {

        // include(app_path() . '/../includes/getsourcegd.php');
        include(app_path() . '/../includes/simple_html_dom.php');

        // $html = curl1($link);

        // $html = $this -> curl($link); 
        // $html_explode = explode("<script>", $html);

        $html = file_get_html($link);
        $all_script = $html -> find('script');  

        //Via SIMPLE HTML DOM
        $get_script_video = $all_script[6] -> innertext;

        // $get_script_video = $html_explode[6];
        $script_video_decrypt1 = str_replace("\u003d", "=", $get_script_video);
        $script_video_decrypt2 = str_replace("\u0026", "&", $script_video_decrypt1);
        $script_video_decrypt3 = str_replace("%2C", ",", $script_video_decrypt2);

        preg_match_all("/\[[^\]]*\]/", $script_video_decrypt3, $matches);

        $all_link_vid_detail = $matches[0][25];

        preg_match_all('/"(.*?)"/', $all_link_vid_detail, $all_link_vid_detail_arr);
        $all_link_vid = substr($all_link_vid_detail_arr[0][1], 1, -1);
        $all_link_vid_arr = explode("|", $all_link_vid);

        $i = 0;
        $count_all_link = count($all_link_vid_arr);

        while ( $i < ($count_all_link-1)) 
            {
                if ( $i == 0 )
                    {
                        $datalink[$all_link_vid_arr[0]] = preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",substr($all_link_vid_arr[1], 0, -3));

                    }
                else if( $i == ($count_all_link-1) )
                    {
                        $datalink[substr($all_link_vid_arr[$i-1], -2, 2)] = preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",$all_link_vid_arr[$i+1]);
                    }
                else
                    {
                        $datalink[substr($all_link_vid_arr[$i], -2, 2)] = preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",substr($all_link_vid_arr[$i+1], 0, -3));
                    }
                $i++;
            }

        unset($datalink[59], $datalink[35], $datalink[34]);

        return $all_link_vid_arr;
    }

    public function curl($url) {
        $ch = @curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $head[] = "Connection: keep-alive";
        $head[] = "Keep-Alive: 300";
        $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $head[] = "Accept-Language: en-us,en;q=0.5";
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Expect:'
        ));
        $page = curl_exec($ch);
        curl_close($ch);
        return $page;
    }

    public function newcurl($link) {
        $api = 'https://api.blogit.vn/getlink.php?link='.$link;
        $curl = $this -> curl($api);
        $data = json_decode($curl);

        $all_link = $data -> result -> data -> link;
        
        if( count( $all_link != 0) )
            {
                foreach ($all_link as $item) 
                    {
                        if( $item -> label == '1080p' )
                            {
                                $all_data['37'] = str_replace("api_get_link=api.blogit.vn&", "", $item -> file);
                            }
                        else if( $item -> label == '720p' )
                            {
                                $all_data['22'] = str_replace("api_get_link=api.blogit.vn&", "", $item -> file);   
                            }
                        else if( $item -> label == '360p' )
                            {
                                $all_data['18'] = str_replace("api_get_link=api.blogit.vn&", "", $item -> file);      
                            }
                    }
            }
        else
            {
                return false;
            }

        return $all_data;
    }

    public function mc_encrypt($encrypt, $key){
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('H*', $key);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
        return $encoded;
    }
}

