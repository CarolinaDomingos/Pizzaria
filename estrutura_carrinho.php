<?php
//Criação de Carrinho de Compras

// EM BD Tabela carts (cart_id, cart_log_id, cart_hash, cart_status)
// EM BD Tabela itens (itens_id, itens_cart_id, itens_prd_id, itens_prd_qta)

//Ciclo:
/*
Ao iniciar sessão ou ao entrar no site criar um carrinho para o user na sessão e registar na BD carts

Ao adicionar item para compra, registar em itens o id do item + o id do carrinho + a qta do item

Ao adicionar + itens do mesmo id alterar so a quantidade
Ao remover itens do mesmo id alterar somente a quantidade, remover se for 0

Status do carrinho é iniciado a 0 e passado a 1 quando o pedido é terminado vazando o carrinho

Para vazar o carrinho, associar novo cart_id a sessão junto com o hash

 */
//Exemplo de gerador de HASH 32 para o carrinho:
$bytes = openssl_random_pseudo_bytes(32);//tamanho da hash pode ser outro
$hash  = bin2hex($bytes);//converter binarios em hexadecimal
//variavel hash gerada para o carrinho

?>