<?php

namespace NickSystem;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase {
  
  public $nicks = ["TeletubbieAndrew", "OhneLimitHD", "LifeRusherHD", "WolfMasterHD", "LegitGamerHD", "UnLegitGamerHD", "LeqitRusherYT", "UnlqeitRusherYT"];
  
  public function onEnable(){
    $this->getLogger()->info(C::GREEN."Aktiviert!");
  }
  public function onDisable(){
    $this->getLogger()->info(C::RED."Deaktiviert!");
  }
  public function action_nick_on($player){
		if(count($this->nicks) === 1){
			$player->setDisplayName($this->nicks[0]);
			$player->setNameTag($this->nicks[0]);
			$pName = $player->getDisplayName();
			unset($this->nicks[0]);
			$this->nicks = array_values($this->nicks);
			$player->sendMessage(C::BOLD.C::GRAY."[".C::GREEN."NickSystem".C::GRAY."]".C::YELLOW."Dein Nickname ist ".C::BLUE.$player->getDisplayName().C::YELLOW."!");
		}
		elseif(count($this->nicks) === 0){
			$player->sendMessage(C::BOLD.C::GRAY."[".C::GREEN."NickSystem".C::GRAY."]".C::RED."Kein Nickname verfuegbar!");
		}
		else{
			$nickNum = mt_rand(0, count($this->nicks)-1);
			$player->setDisplayName($this->nicks[$nickNum]);
			$player->setNameTag($this->nicks[$nickNum]);
			$pName2 = $player->getDisplayName();
			unset($this->nicks[$nickNum]);
			$this->nicks = array_values($this->nicks);
			$player->sendMessage(C::BOLD.C::GRAY."[".C::GREEN."NickSystem".C::GRAY."]".C::YELLOW."Dein Nickname ist ".C::BLUE.$player->getDisplayName().C::YELLOW."!");
		}
	}
	public function action_nick_off($player){
		array_push($this->nicks, $player->getDisplayName());
		$player->setDisplayName($player->getName());
		$player->setNameTag($player->getName());
	}
  public function onCommand(CommandSender $sender, Command $command, $label, array $args){
    switch(strtolower($command->getName())){
      case "nick":
        if(strtolower($args[0]) === "on"){
        	$this->action_nick_on($sender);
        }
        elseif(strtolower($args[0]) === "off"){
        	$this->action_nick_off($sender);
        }
        break;
    }
  }
}
