<?php

use Mpociot\BotMan\Messages\Message;
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('Hello!', function ($bot) {
    $bot->reply('Hi');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');
$botman->hears('i want to take admission in college', function ($bot) {
    $bot->reply('Where do you want to take admission');
});
$botman->hears('top 5 colleges in bhopal', function ($bot) {
    $bot->reply("1. Technocrats Institute College of Technology");
    $bot->reply("2. Rkdf Institute of Science And Technology");
    $bot->reply("3. Technocrats Institute of Technology(excellence)");
    $bot->reply("4. Sri Satya Sai College of Engineering");
    $bot->reply("5. Bhabha Engineering Research India - mca");
    $bot->reply("1. Technocrats Institute College of Technology\n2. Rkdf Institute of Science And Technology\n3. Technocrats Institute of Technology(excellence)\n4. Sri Satya Sai College of Engineering\n5. Bhabha Engineering Research India - mca");
});

$botman->hears('button', function($bot) {
$bot->reply(ButtonTemplate::create('Do you want to know more about BotMan?')
	->addButton(ElementButton::create('Tell me more')->type('postback')->payload('tellmemore'))
	->addButton(ElementButton::create('Show me the docs')->url('http://botman.io/'))
    );
});

$botman->hears('generic', function($bot) {
$bot->reply(GenericTemplate::create()
	->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
	->addElements([
		Element::create('BotMan Documentation')
			->subtitle('All about BotMan')
			->image('http://botman.io/img/botman-body.png')
			->addButton(ElementButton::create('visit')->url('http://botman.io'))
			->addButton(ElementButton::create('tell me more')
				->payload('tellmemore')->type('postback')),
		Element::create('BotMan Laravel Starter')
			->subtitle('This is the best way to start with Laravel and BotMan')
			->image('http://botman.io/img/botman-body.png')
			->addButton(ElementButton::create('visit')
				->url('https://github.com/mpociot/botman-laravel-starter')
			)
	])
);
});
