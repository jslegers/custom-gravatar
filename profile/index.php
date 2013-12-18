<?php
if (isset($_SERVER['ORIG_PATH_INFO'])) {
    $pathinfo = $_SERVER['ORIG_PATH_INFO'];
} elseif (isset($_SERVER['PATH_INFO'])) {
    $pathinfo = $_SERVER['PATH_INFO'];
} else {
    $pathinfo = '';
}

if ($pathinfo != '') {
    $pathinfo = explode('/', urldecode($_SERVER['PATH_INFO']));
    array_shift($pathinfo);
}

if ($pathinfo[count($pathinfo) - 1] == '') {
    $droplast = array_pop($pathinfo);
}

if ($pathinfo[0] == '') {
    $pathinfo[0] = 'beau';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Gravatar toolset</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" media="all" href="cascade/build-full.min.css">
        <link rel="stylesheet" type="text/css" media="all" href="cascade/icons-ie7.min.css">
        <meta name="description" content="Create your own custom Gravatar profiles">
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .powered-by {
                background: url('http://www.cascade-framework.com/assets/img/cascade icons/powered-by.png');
                width: 150px;
                height: 56px;
                display: block;
            }

            .identifier {
                text-align:right;
                width: 15%;
                font-weight: 700;
            }

            .detailed .figure {
                overflow: hidden;
            }

            .photo {
                margin: 0;
            }

            .detailed .photo {
                display: block;
                width: 100%;
                height: 100%;
            }

            .gallery li {
                border-width: 1px;
                margin: 0 5px 5px 0;
                display: block;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
            }

            .gallery img {
                margin: 5px;
                float: left;
                *float: none;
            }

            .photos li {
                cursor: pointer;
            }

            .photos img {
                height: 80px;
            }

            .avatar, .QR {
                clear: both;
            }
            
            .avatars .title {
                margin: 0 15px;
            }

            .gallery .title {
                display: block;
                clear: both;
                padding: 0 5px 5px 5px;
            }

            h1 .icon {
                font-weight: 300;
            }

            .links {
                margin-top: -1px;
            }

            .links .icon {
                margin: -1px 10px 0 0;
                font-size: 20px;
                font-weight: 300;
                width: 20px;
                height: 20px;
                *font-size: 16px;
            }

            .links a {
                padding: 4px 0;
            }

            .hide {
                position: absolute;
                height: 0px;
                display: none;
                *display: inline;
            }

            @media (max-width: 979px) {
                .websites img {
                    width: 150px;
                }
            }

            @media (max-width: 767px) {
                .body:last-child {
                    -webkit-border-radius: 0;
                    -moz-border-radius: 0;
                    border-radius: 0;
                }

                .identifier {
                    text-align:left;
                    background: #ccc;
                    -webkit-border-radius: 8px;
                    -moz-border-radius: 8px;
                    border-radius: 8px;
                    margin: 5px 0;
                }

                .col.left-bar {
                    width: 484px !important;
                    float: none !important;
                    margin: 20px auto;
                }

                .avatar.col, .QR.col {
                    clear: none;
                }

                .websites img {
                    width: 280px;
                }

                .websites {
                    margin: 0 auto 20px auto;
                }
            }

            @media (max-width: 650px) {
                .websites img {
                    width: 200px;
                }
            }

            @media (max-width: 520px) {
                .col.left-bar {
                    width: 242px !important;
                }

                .websites img {
                    width: 120px;
                }
            }

            @media (max-width: 400px) {
                .websites a {
                    float: none;
                    padding: 5px;
                    display: block;
                }

                .websites img, .websites li, .websites ul, .websites .title {
                    width: 100%;
                    margin: 0;
                    float: none;
                    padding: 0;
                }

                .websites li {
                    margin: 10px 0;
                }

                h1 .icon {
                    display: none;
                }
            }

            @media (max-width: 310px) {
                h1 small {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div class="site-center">
            <div class="site-body panel">
                <div class="body">
                    <div class="cell">
                        <div class="col">
                            <div class="col">
                                <div class="cell">
                                    <div class="page-header">
                                        <h1>
                                            <span class="icon icon-64 icon-user"></span>
                                            <span class="n">
                                                <span class="fn"></span>
                                                <small>profile</small>
                                            </span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col left-bar width-fit mobile-width-fit">
                                <div class="col avatar width-fit mobile-width-fit">
                                    <div class="cell panel">
                                        <div class="body">
                                            <div class="cell">
                                                <div class="figure">
                                                    <img class="photo" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col QR width-fit mobile-width-fit">
                                    <div class="cell panel">
                                        <div class="body">
                                            <div class="cell">
                                                <div class="figure">
                                                    <img class="photo" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <div class="col name-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                Name:
                                            </div>
                                        </div>
                                        <div class="col width-fill">
                                            <div class="n cell">
                                                <span class="given-name"></span>
                                                <span class="family-name"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col nickname-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                Nickname:
                                            </div>
                                        </div>
                                        <div class="col width-fill">
                                            <div class="nickname cell">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col hash-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                Hash:
                                            </div>
                                        </div>
                                        <div class="col width-fill">
                                            <div class="hash cell">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col location-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                Location:
                                            </div>
                                        </div>
                                        <div class="col width-fill">
                                            <div class="cell adr">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col note-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                About me:
                                            </div>
                                        </div>
                                        <div class="col width-fill">
                                            <div class="cell note">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col telephone-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                Telephone:
                                            </div>
                                        </div>
                                        <div class="col width-fill">
                                            <div class="cell">
                                                <span class="tel"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col email-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                Email:
                                            </div>
                                        </div>
                                        <div class="col width-fill">
                                            <div class="cell">
                                                <a class="email"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col im-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                IM:
                                            </div>
                                        </div>
                                        <div class="col ims width-fill">
                                            <div class="col">
                                                <div class="cell">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col accounts-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                Social:
                                            </div>
                                        </div>
                                        <div class="col social width-fill">
                                            <div class="col">
                                                <div class="menu cell">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col avatars-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                Avatars:
                                            </div>
                                        </div>
                                        <div class="col avatars width-fill">
                                            <div class="col">
                                                <div class="gallery cell">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col urls-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                Websites:
                                            </div>
                                        </div>
                                        <div class="col websites width-fill">
                                            <div class="col">
                                                <div class="gallery cell">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col photos-section">
                                        <div class="col identifier">
                                            <div class="cell">
                                                Photos:
                                            </div>
                                        </div>
                                        <div class="col photos width-fill">
                                            <div class="col">
                                                <div class="gallery cell">
                                                </div>
                                            </div>
                                            <div class="col detailed">
                                                <div class="cell panel">
                                                    <div class="body">
                                                        <div class="cell">
                                                            <div class="figure">
                                                                <img class="photo" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer">
                <div class="cell">
                    <span class="float-right">
                        © 2013, <a href="https://twitter.com/johnslegers">John Slegers</a>
                    </span>
                    <a href="test.html" class="powered-by"></a>
                </div>
            </div>
        </div>
        <script type="text/javascript" src='jquery.js'></script>
        <script type="text/javascript">
            var resizephoto = function(url) {
                var width = $('.detailed .figure')[0].clientWidth;
                var src = url + '?size=' + width;
                $('.detailed .photo')
                        .attr("src", src);

            }
            var process = function(data) {
                console.log(data);
                if (data.displayName)
                    $('.fn').text(data.displayName);
                else
                    $('.name-section').addClass('hide');
                if (data.name && data.name.length > 0) {
                    if (data.name.givenName)
                        $('.given-name').text(data.name.givenName);
                    if (data.name.familyName)
                        $('.family-name').text(data.name.familyName);
                    if (data.name.familyName)
                        $('.family-name').text(data.name.familyName);
                } else {
                    $('.name-section').addClass('hide');
                }
                if (data.hash)
                    $('.hash').html(data.hash);
                else
                    $('.hash-section').addClass('hide');
                if (data.aboutMe)
                    $('.note').html(data.aboutMe);
                else
                    $('.note-section').addClass('hide');
                if (data.thumbnailUrl)
                    $('.avatar .photo').attr("src", data.thumbnailUrl + '?size=200');
                if (data.QR)
                    $('.QR .photo').attr("src", data.QR + '?size=200');
                if (data.currentLocation)
                    $('.adr').text(data.currentLocation);
                else
                    $('.location-section').addClass('hide');
                if (data.username)
                    $('.nickname').text(data.username);
                else
                    $('.nickname-section').addClass('hide');
                if (data.phoneNumbers && data.phoneNumbers.length > 0)
                    $('.tel').text(data.phoneNumbers[0].value);
                else
                    $('.telephone-section').addClass('hide');
                if (data.emails && data.emails.length > 0)
                    $('.email').attr("href", 'mailto:' + data.emails[0].value).text(data.emails[0].value);
                else
                    $('.email-section').addClass('hide');
                if (data.photos && data.photos.length > 0) {
                    var photos = [];
                    resizephoto(data.photos[0].value);
                    $.each(data.photos, function(key, val) {
                        photos.push("<li id='photo-" + key + "'><img src='" + val.value + "' class='photo' /></li>");
                    });
                    if (photos.length > 0) {
                        $("<ul/>", {
                            "class": "nav",
                            html: photos.join("")
                        }).appendTo(".photos .gallery");
                        $.each(data.photos, function(key, val) {
                            $("#photo-" + key).click(function() {
                                resizephoto(val.value);
                            });
                        });
                    }
                } else
                    $('.photos-section').addClass('hide');
                if (data.urls && data.urls.length > 0) {
                    var websites = [];
                    $.each(data.urls, function(key, val) {
                        websites.push("<li id='websites-" + key + "'><a target='_blank' href='" + val.value + "' class='url'><img src='" + val.screenshot + "?w=240' class='photo' /><span class='title'>" + val.title + "</span></a></li>");
                    });
                    if (websites.length > 0) {
                        $("<ul/>", {
                            "class": "nav",
                            html: websites.join("")
                        }).appendTo(".websites .gallery");
                    }
                } else
                    $('.urls-section').addClass('hide');
                if (data.ims && data.ims.length > 0) {
                    var ims = [];
                    $.each(data.ims, function(key, val) {
                        ims.push("<li id='accounts-" + key + "'><b>" + val.type + ": </b><span>" + val.value + "</span></li>");
                    });
                    if (ims.length > 0) {
                        $("<ul/>", {
                            "class": "left nav",
                            html: ims.join("")
                        }).appendTo(".ims .cell");
                    }
                } else
                    $('.im-section').addClass('hide');
                if (data.avatars) {
                    var avatars = [];
                    $.each(data.avatars, function(key, val) {
                        avatars.push("<li id='avatars-" + key + "'><img src='" + val + "&s=50' class='photo' /><span class='title'>" + key + "</span></li>");
                    });
                    if (avatars.length > 0) {
                        $("<ul/>", {
                            "class": "nav",
                            html: avatars.join("")
                        }).appendTo(".avatars .gallery");
                    }
                } else
                    $('.avatars-section').addClass('hide');
                if (data.accounts && data.accounts.length > 0) {
                    var social = [];
                    $.each(data.accounts, function(key, val) {
                        if (val.shortname === 'google') {
                            val.shortname = 'google-plus-sign';
                        } else if (val.shortname === 'wordpress') {
                            val.shortname = 'circle';
                        } else if (val.shortname === 'tripit') {
                            val.shortname = 'circle';
                        }
                        social.push("<li id='accounts-" + key + "'><a target='_blank' href='" + val.url + "' class='url'><span class='icon icon-" + val.shortname + "'></span><span>" + val.display + "</span></a></li>");
                    });
                    if (social.length > 0) {
                        $("<ul/>", {
                            "class": "left links nav",
                            html: social.join("")
                        }).appendTo(".social .menu");
                    }
                } else
                    $('.accounts-section').addClass('hide');
            }

            $.getJSON("gravatarservice/<?php echo $pathinfo[0]; ?>", process);
        </script>
    </body>
</html>
