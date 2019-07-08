<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace ExamplePlugin;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\entity\ProjectileHitEntityEvent;
use pocketmine\event\entity\ProjectileHitBlockEvent;
use pocketmine\event\entity\Projectile;
use pocketmine\level\particle\ExplodeParticle;
use pocketmine\level\Explosion;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\item\Item;
use pocketmine\item\Arrow;


class ExampleListener implements Listener{

	/** @var MainClass */
	private $plugin;
	

	public function __construct(MainClass $plugin){
		$this->plugin = $plugin;
	}

	/**
	 * @param PlayerRespawnEvent $event
	 *
	 * @priority        NORMAL
	 * @ignoreCancelled false
	 */
	public function onSpawn(PlayerRespawnEvent $event) : void{
		$this->plugin->getServer()->broadcastMessage($event->getPlayer()->getDisplayName() . " has just spawned!");
	}


	/**
	 * @param PlayerJoinEvent $event
	 *
	 * @priority        NORMAL
	 * @ignoreCancelled false
	 */
	public function onJoin(PlayerJoinEvent $event) : void{

		$playerName = $event->getPlayer()->getDisplayName();


		if ($playerName == "marlonjava") {
			$this->plugin->getServer()->broadcastTitle($playerName . " the God, has just joined!");
		} else {
			$this->plugin->getServer()->broadcastMessage($playerName . " has just joined!");
		}
		

		$event->getPlayer()->setCanClimbWalls(true);
	
		$event->getPlayer()->getInventory()->addItem(Item::get(262, 0, 100), Item::get(261, 0, 1));

		

		
	}

	/**
	 * @param ProjectileHitEntityEvent $event
	 *
	 * @priority        NORMAL
	 * @ignoreCancelled false
	 */
	public function onEntityHit(ProjectileHitEntityEvent $event) : void{

		// $this->plugin->getServer()->broadcastMessage("onEntityHit");
		
		// $entityHit =  $event->getEntityHit();

		
		// $this->plugin->getServer()->broadcastMessage($entityHit->getNameTag() . " was hit!");


	
		// // $level = $this->plugin->getServer()->getLevelByName("world");
		
		
		// // $level->addParticle(new ExplodeParticle(new Vector3($entityHit->x, $entityHit->y, $entityHit->z)));

		// $explosion = new Explosion($this, 1000, $this); 
		// $explosion->spawnTo($entityHit);
		// $explosion->explodeA();

	}


	/**
	 * @param ProjectileHitBlockEvent $event
	 *
	 * @priority        NORMAL
	 * @ignoreCancelled false
	 */
	public function onBlockHit(ProjectileHitBlockEvent $event) : void{

		// $this->plugin->getServer()->broadcastMessage("onBlockHit");

		$blockHit =  $event->getBlockHit();

		$level = $this->plugin->getServer()->getLevelByName("world");

		if ($event->getEntity() instanceof Arrow) {
			$explosion = new Explosion(new Position($blockHit->x, $blockHit->y, $blockHit->z, $level), 5, $blockHit); 
			$explosion->explodeA();
			$explosion->explodeB();
		}
		

		
		


		

	}
	

	



}
