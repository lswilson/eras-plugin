<?php
/**
 * Plugin Name:	Eras Plugin
 * Description:	When activated, this plugin displays random lyrics from Taylor Swifts songs in the top right corner of your WordPress Dashboard.
 * Version:	1.0
 * Author:	Lisa Sabin-Wilson
 * Twitter:	@LisaSabinWilson
 * Author URI:	https://lisasabin-wilson.com
 * License:	GPL-2.0-or-later
 * License URI:	https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:	eras-plugin
 *
 * @package	Eras Plugin
 *
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	For more information please see <http://www.gnu.org/licenses/>.
*/

function taylor_get_lyric() {
	/** These are popular Taylor Swift lyrics */
	$lyrics = "Shake it off
	I remember it all too well
	Burn this house to the ground
	F*ck the patriarchy!
	Was it worth it?
	Down bad crying at the gym
	Where ever you stray I follow
	Another time and place
	A friend to all is a friend to none
	I once was poison ivy, but now I'm your daisy
	Good ideas and power moves
	Flames on my skin
	Like a tattooed golden retriever
	Smallest man who ever lived
	Were you sent by someone who wanted me dead?
	Did you sleep with a gun underneath our bed?
	Were you writing a book?
	Are you a sleeper cell spy
	In 50 years will all this be declassified?
	Break me like a promise
	Start of an age
	A dwindling mercurial high
	The reason you can't sleep
	I gave so many signs
	That red lip classic thing that you like
	We never go out of style
	No rules in breakable heaven
	I love you it's ruining my life
	Another day, another drama drama
	It was war, it wasn't fair
	I don't know what I want, so don't ask me
	You made a rebel of a careless man’s careful daughter
	Give me something that’ll haunt me when you’re not around
	You gave me roses, and I left them there to die
	Take pictures in your mind of your childhood room
	Two A.M., who do you love?
	No amount of vintage dresses gives you dignity.
	Wasn’t it easier in your lunchbox days?
	So I’ll watch your life in pictures like I used to watch you sleep
	For a moment, a band of thieves in ripped-up jeans got to rule the world
	Love is a ruthless game
	We’re dancing ’round the kitchen in the refrigerator light
	I don't know about you, but I'm feelin' twenty-two
	We are never ever ever getting back together .. like, ever
	Put my name at the top of your list
	Im' a nightmare dressed like a daydream
	Don’t you dream impossible things?
	Got a long list of ex-lovers; they’ll tell you I’m insane
	The monsters turned out to be just trees
	People like you always want back the love they pushed aside
	Something happens when everybody finds out
	Like a wine-stained dress I can’t wear anymore
	And in the end, in Wonderland, we both went mad
	Are you ready for it?
	Every love I’ve known in comparison is a failure
	I bury hatchets, but I keep maps of where I put ’em
	If a man talks shit, then I owe him nothing
	I once was poison ivy, but now I’m your daisy
	My reputation’s never been worse, so you must like me for me
	Honey, I rose up from the dead; I do it all the time
	It was the great escape, the prison break
	King of my heart
	This is why we can't have nice things
	Snuck in through the garden gate
	I love you; ain’t that the worst thing you ever heard?
	I swear to be overdramatic — and true!
	You play stupid games, you win stupid prizes
	I’ll be all right; it’s just a thousand cuts
	I’m the only one of me, baby, that’s the fun of me!
	You know the greatest loves of all time are over now
	Chasing shadows in the grocery line
	It must’ve been her fault his heart gave out
	I didn’t have it in myself to go with grace
	Head on the pillow, I could feel you sneaking in
	Long limbs and frozen swims
	Writing letters addressed to the fire
	A never-needy, ever-lovely jewel whose shine reflects on you
	The rust that grew between telephones
	Draw the cat eye sharp enough to kill a man
	I’ll stare directly at the sun but never in the mirror
	Karma’s a relaxing thought
	I’ve been scheming like a criminal ever since
	You know there’s many different ways that you can kill the one you love
	I don’t have to pretend I like acid rock
	You dream of my mouth before it called you a lying traitor
	My boy only breaks his favorite toys
	I’m queen of sand castles he destroys
	I’m pissed off you let me give you all that youth for free
	I dream of cracking locks
	Throwin’ my life to the wolves or the ocean rocks
	Am I bad or mad or wise?
	I was tame, I was gentle ’til the circus life made me mean
	Don’t you worry folks we took out all her teeth
	You caged me and then you called me crazy
	I am what I am ’cause you trained me
	The dopamine races through his brain on a six-lane Texas highway
	I wish I could unrecall how we almost had it all
	Lights, camera, b*tch, smile
	You deserve prison, but you won’t get time
	I built a legacy which you can’t undo
	That there wouldn’t be this, if there hadn’t been you
	Faster than the wind, passionate as sin
	The rest of the world was black and white but we were in screaming color
	Say you'll remember me standing in a nice dress, staring at the sunset
	I knew it from the first old fashioned, we were cursed
	Devils roll the dice, angels roll their eyes
	You look like Taylor Swift in this light, we’re loving it
	Why you gotta be so mean?
	It's me, hi, I'm the problem, it's me
	She had a marvelous time ruining everything.
	She needed cold hard proof so I gave her some.
 	I cry a lot but I am so productive, It’s an art
 	See the lights, see the party, the ball gowns
";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function taylor_swift() {
	$chosen = taylor_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="taylor"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Lyrics from Taylor Swift' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'taylor_swift' );

// We need some CSS to position the paragraph.
function taylor_css() {
	echo "
	<style type='text/css'>
	#taylor {
		float: right;
		padding: 2px 10px;
		margin: 0;
		font-size: 18px;
		font-style: italic;
		line-height: 1.6666;
	}

	#taylor::before {
		content:'♫';
		display: inline-block;
		width: 15px;
		height: 15px;
		margin-right: 5px;
	}

	.rtl #taylor {
		float: left;
	}

	.block-editor-page #taylor {
		display: none;
	}

	@media screen and (max-width: 782px) {
		#taylor,
		.rtl #taylor {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'taylor_css' );
