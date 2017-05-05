-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 24-02-2011 a las 14:34:54
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `us`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `invitacion`
-- 

CREATE TABLE `invitacion` (
  `ID` int(9) unsigned NOT NULL auto_increment,
  `de` varchar(180) default NULL,
  `para` varchar(180) default NULL,
  `hash` varchar(180) default NULL,
  `valido` varchar(10) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `invitacion`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
-- 

CREATE TABLE `usuarios` (
  `ID` int(9) unsigned NOT NULL auto_increment,
  `username` varchar(180) default NULL,
  `password` varchar(180) default NULL,
  `email` varchar(180) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

INSERT INTO `usuarios` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'marco.fbb@gmail.com');

