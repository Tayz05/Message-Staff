<?php

namespace MsgStaff;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info(TextFormat::GREEN . "MsgStaff plugin activé !");
    }

    public function onDisable(): void {
        $this->getLogger()->info(TextFormat::RED . "MsgStaff plugin désactivé !");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "msgstaff") {
            if (count($args) < 2) {
                $sender->sendMessage(TextFormat::RED . "Usage: /msgstaff {Player} {message}");
                return false;
            }

            $targetName = array_shift($args);
            $message = implode(" ", $args);

            $targetPlayer = $this->getServer()->getPlayerByPrefix($targetName);

            if ($targetPlayer instanceof Player) {
                $targetPlayer->sendTitle(TextFormat::GOLD . "Message du staff", TextFormat::WHITE . $message);
                $sender->sendMessage(TextFormat::GREEN . "Message envoyé à " . $targetPlayer->getName());
            } else {
                $sender->sendMessage(TextFormat::RED . "Joueur introuvable.");
            }
            return true;
        }
        return false;
    }
}
