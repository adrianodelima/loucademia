<?php
abstract class DaoFactory {

    protected abstract function getConnection();

    public abstract function getAcessoDao();

    public abstract function getPagamentoDao();

    public abstract function getUsuarioDao();

    public abstract function getTreinoDao();

    public abstract function getTreinoUsuarioDao();
}
?>