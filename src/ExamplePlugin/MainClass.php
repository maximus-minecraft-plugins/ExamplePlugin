<?php

declare(strict_types=1);

namespace ExamplePlugin;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class MainClass extends PluginBase{

	private $server;
	


	public function onLoad() : void{
		$this->getLogger()->info(TextFormat::WHITE . "I've been loaded!");


		
	}

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents(new ExampleListener($this), $this);
		$this->getScheduler()->scheduleRepeatingTask(new BroadcastTask($this->getServer()), 120);
		$this->getLogger()->info(TextFormat::DARK_GREEN . "I've been enabled!");
	}

	public function onDisable() : void{
		$this->getLogger()->info(TextFormat::DARK_RED . "I've been disabled!");
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch($command->getName()){
			case "example":
				$sender->sendMessage("Hello " . $sender->getName() . "!");

				return true;

			case "house":
				
				$sender->sendMessage("Please wait we are building your house.");
				return true;
			default:
				return false;
		}
	}


}
