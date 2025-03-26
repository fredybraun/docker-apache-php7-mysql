-- MySQL dump 10.19  Distrib 10.3.28-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: performance_schema
-- ------------------------------------------------------
-- Server version	10.3.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `performance_schema`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `performance_schema` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `performance_schema`;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `USER` char(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `HOST` char(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `CURRENT_CONNECTIONS` bigint(20) NOT NULL,
  `TOTAL_CONNECTIONS` bigint(20) NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cond_instances`
--

DROP TABLE IF EXISTS `cond_instances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cond_instances` (
  `NAME` varchar(128) NOT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cond_instances`
--

LOCK TABLES `cond_instances` WRITE;
/*!40000 ALTER TABLE `cond_instances` DISABLE KEYS */;
/*!40000 ALTER TABLE `cond_instances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_stages_current`
--

DROP TABLE IF EXISTS `events_stages_current`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_stages_current` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_ID` bigint(20) unsigned NOT NULL,
  `END_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `SOURCE` varchar(64) DEFAULT NULL,
  `TIMER_START` bigint(20) unsigned DEFAULT NULL,
  `TIMER_END` bigint(20) unsigned DEFAULT NULL,
  `TIMER_WAIT` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_TYPE` enum('STATEMENT','STAGE','WAIT') DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_stages_current`
--

LOCK TABLES `events_stages_current` WRITE;
/*!40000 ALTER TABLE `events_stages_current` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_stages_current` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_stages_history`
--

DROP TABLE IF EXISTS `events_stages_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_stages_history` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_ID` bigint(20) unsigned NOT NULL,
  `END_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `SOURCE` varchar(64) DEFAULT NULL,
  `TIMER_START` bigint(20) unsigned DEFAULT NULL,
  `TIMER_END` bigint(20) unsigned DEFAULT NULL,
  `TIMER_WAIT` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_TYPE` enum('STATEMENT','STAGE','WAIT') DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_stages_history`
--

LOCK TABLES `events_stages_history` WRITE;
/*!40000 ALTER TABLE `events_stages_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_stages_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_stages_history_long`
--

DROP TABLE IF EXISTS `events_stages_history_long`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_stages_history_long` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_ID` bigint(20) unsigned NOT NULL,
  `END_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `SOURCE` varchar(64) DEFAULT NULL,
  `TIMER_START` bigint(20) unsigned DEFAULT NULL,
  `TIMER_END` bigint(20) unsigned DEFAULT NULL,
  `TIMER_WAIT` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_TYPE` enum('STATEMENT','STAGE','WAIT') DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_stages_history_long`
--

LOCK TABLES `events_stages_history_long` WRITE;
/*!40000 ALTER TABLE `events_stages_history_long` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_stages_history_long` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_stages_summary_by_account_by_event_name`
--

DROP TABLE IF EXISTS `events_stages_summary_by_account_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_stages_summary_by_account_by_event_name` (
  `USER` char(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `HOST` char(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_stages_summary_by_account_by_event_name`
--

LOCK TABLES `events_stages_summary_by_account_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_stages_summary_by_account_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_stages_summary_by_account_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_stages_summary_by_host_by_event_name`
--

DROP TABLE IF EXISTS `events_stages_summary_by_host_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_stages_summary_by_host_by_event_name` (
  `HOST` char(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_stages_summary_by_host_by_event_name`
--

LOCK TABLES `events_stages_summary_by_host_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_stages_summary_by_host_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_stages_summary_by_host_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_stages_summary_by_thread_by_event_name`
--

DROP TABLE IF EXISTS `events_stages_summary_by_thread_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_stages_summary_by_thread_by_event_name` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_stages_summary_by_thread_by_event_name`
--

LOCK TABLES `events_stages_summary_by_thread_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_stages_summary_by_thread_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_stages_summary_by_thread_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_stages_summary_by_user_by_event_name`
--

DROP TABLE IF EXISTS `events_stages_summary_by_user_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_stages_summary_by_user_by_event_name` (
  `USER` char(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_stages_summary_by_user_by_event_name`
--

LOCK TABLES `events_stages_summary_by_user_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_stages_summary_by_user_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_stages_summary_by_user_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_stages_summary_global_by_event_name`
--

DROP TABLE IF EXISTS `events_stages_summary_global_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_stages_summary_global_by_event_name` (
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_stages_summary_global_by_event_name`
--

LOCK TABLES `events_stages_summary_global_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_stages_summary_global_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_stages_summary_global_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_statements_current`
--

DROP TABLE IF EXISTS `events_statements_current`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_statements_current` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_ID` bigint(20) unsigned NOT NULL,
  `END_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `SOURCE` varchar(64) DEFAULT NULL,
  `TIMER_START` bigint(20) unsigned DEFAULT NULL,
  `TIMER_END` bigint(20) unsigned DEFAULT NULL,
  `TIMER_WAIT` bigint(20) unsigned DEFAULT NULL,
  `LOCK_TIME` bigint(20) unsigned NOT NULL,
  `SQL_TEXT` longtext DEFAULT NULL,
  `DIGEST` varchar(32) DEFAULT NULL,
  `DIGEST_TEXT` longtext DEFAULT NULL,
  `CURRENT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_TYPE` varchar(64) DEFAULT NULL,
  `OBJECT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_NAME` varchar(64) DEFAULT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned DEFAULT NULL,
  `MYSQL_ERRNO` int(11) DEFAULT NULL,
  `RETURNED_SQLSTATE` varchar(5) DEFAULT NULL,
  `MESSAGE_TEXT` varchar(128) DEFAULT NULL,
  `ERRORS` bigint(20) unsigned NOT NULL,
  `WARNINGS` bigint(20) unsigned NOT NULL,
  `ROWS_AFFECTED` bigint(20) unsigned NOT NULL,
  `ROWS_SENT` bigint(20) unsigned NOT NULL,
  `ROWS_EXAMINED` bigint(20) unsigned NOT NULL,
  `CREATED_TMP_DISK_TABLES` bigint(20) unsigned NOT NULL,
  `CREATED_TMP_TABLES` bigint(20) unsigned NOT NULL,
  `SELECT_FULL_JOIN` bigint(20) unsigned NOT NULL,
  `SELECT_FULL_RANGE_JOIN` bigint(20) unsigned NOT NULL,
  `SELECT_RANGE` bigint(20) unsigned NOT NULL,
  `SELECT_RANGE_CHECK` bigint(20) unsigned NOT NULL,
  `SELECT_SCAN` bigint(20) unsigned NOT NULL,
  `SORT_MERGE_PASSES` bigint(20) unsigned NOT NULL,
  `SORT_RANGE` bigint(20) unsigned NOT NULL,
  `SORT_ROWS` bigint(20) unsigned NOT NULL,
  `SORT_SCAN` bigint(20) unsigned NOT NULL,
  `NO_INDEX_USED` bigint(20) unsigned NOT NULL,
  `NO_GOOD_INDEX_USED` bigint(20) unsigned NOT NULL,
  `NESTING_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_TYPE` enum('STATEMENT','STAGE','WAIT') DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_statements_current`
--

LOCK TABLES `events_statements_current` WRITE;
/*!40000 ALTER TABLE `events_statements_current` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_statements_current` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_statements_history`
--

DROP TABLE IF EXISTS `events_statements_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_statements_history` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_ID` bigint(20) unsigned NOT NULL,
  `END_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `SOURCE` varchar(64) DEFAULT NULL,
  `TIMER_START` bigint(20) unsigned DEFAULT NULL,
  `TIMER_END` bigint(20) unsigned DEFAULT NULL,
  `TIMER_WAIT` bigint(20) unsigned DEFAULT NULL,
  `LOCK_TIME` bigint(20) unsigned NOT NULL,
  `SQL_TEXT` longtext DEFAULT NULL,
  `DIGEST` varchar(32) DEFAULT NULL,
  `DIGEST_TEXT` longtext DEFAULT NULL,
  `CURRENT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_TYPE` varchar(64) DEFAULT NULL,
  `OBJECT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_NAME` varchar(64) DEFAULT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned DEFAULT NULL,
  `MYSQL_ERRNO` int(11) DEFAULT NULL,
  `RETURNED_SQLSTATE` varchar(5) DEFAULT NULL,
  `MESSAGE_TEXT` varchar(128) DEFAULT NULL,
  `ERRORS` bigint(20) unsigned NOT NULL,
  `WARNINGS` bigint(20) unsigned NOT NULL,
  `ROWS_AFFECTED` bigint(20) unsigned NOT NULL,
  `ROWS_SENT` bigint(20) unsigned NOT NULL,
  `ROWS_EXAMINED` bigint(20) unsigned NOT NULL,
  `CREATED_TMP_DISK_TABLES` bigint(20) unsigned NOT NULL,
  `CREATED_TMP_TABLES` bigint(20) unsigned NOT NULL,
  `SELECT_FULL_JOIN` bigint(20) unsigned NOT NULL,
  `SELECT_FULL_RANGE_JOIN` bigint(20) unsigned NOT NULL,
  `SELECT_RANGE` bigint(20) unsigned NOT NULL,
  `SELECT_RANGE_CHECK` bigint(20) unsigned NOT NULL,
  `SELECT_SCAN` bigint(20) unsigned NOT NULL,
  `SORT_MERGE_PASSES` bigint(20) unsigned NOT NULL,
  `SORT_RANGE` bigint(20) unsigned NOT NULL,
  `SORT_ROWS` bigint(20) unsigned NOT NULL,
  `SORT_SCAN` bigint(20) unsigned NOT NULL,
  `NO_INDEX_USED` bigint(20) unsigned NOT NULL,
  `NO_GOOD_INDEX_USED` bigint(20) unsigned NOT NULL,
  `NESTING_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_TYPE` enum('STATEMENT','STAGE','WAIT') DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_statements_history`
--

LOCK TABLES `events_statements_history` WRITE;
/*!40000 ALTER TABLE `events_statements_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_statements_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_statements_history_long`
--

DROP TABLE IF EXISTS `events_statements_history_long`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_statements_history_long` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_ID` bigint(20) unsigned NOT NULL,
  `END_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `SOURCE` varchar(64) DEFAULT NULL,
  `TIMER_START` bigint(20) unsigned DEFAULT NULL,
  `TIMER_END` bigint(20) unsigned DEFAULT NULL,
  `TIMER_WAIT` bigint(20) unsigned DEFAULT NULL,
  `LOCK_TIME` bigint(20) unsigned NOT NULL,
  `SQL_TEXT` longtext DEFAULT NULL,
  `DIGEST` varchar(32) DEFAULT NULL,
  `DIGEST_TEXT` longtext DEFAULT NULL,
  `CURRENT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_TYPE` varchar(64) DEFAULT NULL,
  `OBJECT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_NAME` varchar(64) DEFAULT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned DEFAULT NULL,
  `MYSQL_ERRNO` int(11) DEFAULT NULL,
  `RETURNED_SQLSTATE` varchar(5) DEFAULT NULL,
  `MESSAGE_TEXT` varchar(128) DEFAULT NULL,
  `ERRORS` bigint(20) unsigned NOT NULL,
  `WARNINGS` bigint(20) unsigned NOT NULL,
  `ROWS_AFFECTED` bigint(20) unsigned NOT NULL,
  `ROWS_SENT` bigint(20) unsigned NOT NULL,
  `ROWS_EXAMINED` bigint(20) unsigned NOT NULL,
  `CREATED_TMP_DISK_TABLES` bigint(20) unsigned NOT NULL,
  `CREATED_TMP_TABLES` bigint(20) unsigned NOT NULL,
  `SELECT_FULL_JOIN` bigint(20) unsigned NOT NULL,
  `SELECT_FULL_RANGE_JOIN` bigint(20) unsigned NOT NULL,
  `SELECT_RANGE` bigint(20) unsigned NOT NULL,
  `SELECT_RANGE_CHECK` bigint(20) unsigned NOT NULL,
  `SELECT_SCAN` bigint(20) unsigned NOT NULL,
  `SORT_MERGE_PASSES` bigint(20) unsigned NOT NULL,
  `SORT_RANGE` bigint(20) unsigned NOT NULL,
  `SORT_ROWS` bigint(20) unsigned NOT NULL,
  `SORT_SCAN` bigint(20) unsigned NOT NULL,
  `NO_INDEX_USED` bigint(20) unsigned NOT NULL,
  `NO_GOOD_INDEX_USED` bigint(20) unsigned NOT NULL,
  `NESTING_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_TYPE` enum('STATEMENT','STAGE','WAIT') DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_statements_history_long`
--

LOCK TABLES `events_statements_history_long` WRITE;
/*!40000 ALTER TABLE `events_statements_history_long` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_statements_history_long` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_statements_summary_by_account_by_event_name`
--

DROP TABLE IF EXISTS `events_statements_summary_by_account_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_statements_summary_by_account_by_event_name` (
  `USER` char(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `HOST` char(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `SUM_LOCK_TIME` bigint(20) unsigned NOT NULL,
  `SUM_ERRORS` bigint(20) unsigned NOT NULL,
  `SUM_WARNINGS` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_AFFECTED` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_SENT` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_EXAMINED` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_DISK_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_RANGE_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE_CHECK` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_SORT_MERGE_PASSES` bigint(20) unsigned NOT NULL,
  `SUM_SORT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SORT_ROWS` bigint(20) unsigned NOT NULL,
  `SUM_SORT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_NO_INDEX_USED` bigint(20) unsigned NOT NULL,
  `SUM_NO_GOOD_INDEX_USED` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_statements_summary_by_account_by_event_name`
--

LOCK TABLES `events_statements_summary_by_account_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_statements_summary_by_account_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_statements_summary_by_account_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_statements_summary_by_digest`
--

DROP TABLE IF EXISTS `events_statements_summary_by_digest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_statements_summary_by_digest` (
  `SCHEMA_NAME` varchar(64) DEFAULT NULL,
  `DIGEST` varchar(32) DEFAULT NULL,
  `DIGEST_TEXT` longtext DEFAULT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `SUM_LOCK_TIME` bigint(20) unsigned NOT NULL,
  `SUM_ERRORS` bigint(20) unsigned NOT NULL,
  `SUM_WARNINGS` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_AFFECTED` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_SENT` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_EXAMINED` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_DISK_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_RANGE_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE_CHECK` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_SORT_MERGE_PASSES` bigint(20) unsigned NOT NULL,
  `SUM_SORT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SORT_ROWS` bigint(20) unsigned NOT NULL,
  `SUM_SORT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_NO_INDEX_USED` bigint(20) unsigned NOT NULL,
  `SUM_NO_GOOD_INDEX_USED` bigint(20) unsigned NOT NULL,
  `FIRST_SEEN` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LAST_SEEN` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_statements_summary_by_digest`
--

LOCK TABLES `events_statements_summary_by_digest` WRITE;
/*!40000 ALTER TABLE `events_statements_summary_by_digest` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_statements_summary_by_digest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_statements_summary_by_host_by_event_name`
--

DROP TABLE IF EXISTS `events_statements_summary_by_host_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_statements_summary_by_host_by_event_name` (
  `HOST` char(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `SUM_LOCK_TIME` bigint(20) unsigned NOT NULL,
  `SUM_ERRORS` bigint(20) unsigned NOT NULL,
  `SUM_WARNINGS` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_AFFECTED` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_SENT` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_EXAMINED` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_DISK_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_RANGE_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE_CHECK` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_SORT_MERGE_PASSES` bigint(20) unsigned NOT NULL,
  `SUM_SORT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SORT_ROWS` bigint(20) unsigned NOT NULL,
  `SUM_SORT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_NO_INDEX_USED` bigint(20) unsigned NOT NULL,
  `SUM_NO_GOOD_INDEX_USED` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_statements_summary_by_host_by_event_name`
--

LOCK TABLES `events_statements_summary_by_host_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_statements_summary_by_host_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_statements_summary_by_host_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_statements_summary_by_thread_by_event_name`
--

DROP TABLE IF EXISTS `events_statements_summary_by_thread_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_statements_summary_by_thread_by_event_name` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `SUM_LOCK_TIME` bigint(20) unsigned NOT NULL,
  `SUM_ERRORS` bigint(20) unsigned NOT NULL,
  `SUM_WARNINGS` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_AFFECTED` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_SENT` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_EXAMINED` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_DISK_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_RANGE_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE_CHECK` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_SORT_MERGE_PASSES` bigint(20) unsigned NOT NULL,
  `SUM_SORT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SORT_ROWS` bigint(20) unsigned NOT NULL,
  `SUM_SORT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_NO_INDEX_USED` bigint(20) unsigned NOT NULL,
  `SUM_NO_GOOD_INDEX_USED` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_statements_summary_by_thread_by_event_name`
--

LOCK TABLES `events_statements_summary_by_thread_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_statements_summary_by_thread_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_statements_summary_by_thread_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_statements_summary_by_user_by_event_name`
--

DROP TABLE IF EXISTS `events_statements_summary_by_user_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_statements_summary_by_user_by_event_name` (
  `USER` char(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `SUM_LOCK_TIME` bigint(20) unsigned NOT NULL,
  `SUM_ERRORS` bigint(20) unsigned NOT NULL,
  `SUM_WARNINGS` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_AFFECTED` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_SENT` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_EXAMINED` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_DISK_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_RANGE_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE_CHECK` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_SORT_MERGE_PASSES` bigint(20) unsigned NOT NULL,
  `SUM_SORT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SORT_ROWS` bigint(20) unsigned NOT NULL,
  `SUM_SORT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_NO_INDEX_USED` bigint(20) unsigned NOT NULL,
  `SUM_NO_GOOD_INDEX_USED` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_statements_summary_by_user_by_event_name`
--

LOCK TABLES `events_statements_summary_by_user_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_statements_summary_by_user_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_statements_summary_by_user_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_statements_summary_global_by_event_name`
--

DROP TABLE IF EXISTS `events_statements_summary_global_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_statements_summary_global_by_event_name` (
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `SUM_LOCK_TIME` bigint(20) unsigned NOT NULL,
  `SUM_ERRORS` bigint(20) unsigned NOT NULL,
  `SUM_WARNINGS` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_AFFECTED` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_SENT` bigint(20) unsigned NOT NULL,
  `SUM_ROWS_EXAMINED` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_DISK_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_CREATED_TMP_TABLES` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_FULL_RANGE_JOIN` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_RANGE_CHECK` bigint(20) unsigned NOT NULL,
  `SUM_SELECT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_SORT_MERGE_PASSES` bigint(20) unsigned NOT NULL,
  `SUM_SORT_RANGE` bigint(20) unsigned NOT NULL,
  `SUM_SORT_ROWS` bigint(20) unsigned NOT NULL,
  `SUM_SORT_SCAN` bigint(20) unsigned NOT NULL,
  `SUM_NO_INDEX_USED` bigint(20) unsigned NOT NULL,
  `SUM_NO_GOOD_INDEX_USED` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_statements_summary_global_by_event_name`
--

LOCK TABLES `events_statements_summary_global_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_statements_summary_global_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_statements_summary_global_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_waits_current`
--

DROP TABLE IF EXISTS `events_waits_current`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_waits_current` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_ID` bigint(20) unsigned NOT NULL,
  `END_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `SOURCE` varchar(64) DEFAULT NULL,
  `TIMER_START` bigint(20) unsigned DEFAULT NULL,
  `TIMER_END` bigint(20) unsigned DEFAULT NULL,
  `TIMER_WAIT` bigint(20) unsigned DEFAULT NULL,
  `SPINS` int(10) unsigned DEFAULT NULL,
  `OBJECT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_NAME` varchar(512) DEFAULT NULL,
  `INDEX_NAME` varchar(64) DEFAULT NULL,
  `OBJECT_TYPE` varchar(64) DEFAULT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned NOT NULL,
  `NESTING_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_TYPE` enum('STATEMENT','STAGE','WAIT') DEFAULT NULL,
  `OPERATION` varchar(32) NOT NULL,
  `NUMBER_OF_BYTES` bigint(20) DEFAULT NULL,
  `FLAGS` int(10) unsigned DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_waits_current`
--

LOCK TABLES `events_waits_current` WRITE;
/*!40000 ALTER TABLE `events_waits_current` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_waits_current` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_waits_history`
--

DROP TABLE IF EXISTS `events_waits_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_waits_history` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_ID` bigint(20) unsigned NOT NULL,
  `END_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `SOURCE` varchar(64) DEFAULT NULL,
  `TIMER_START` bigint(20) unsigned DEFAULT NULL,
  `TIMER_END` bigint(20) unsigned DEFAULT NULL,
  `TIMER_WAIT` bigint(20) unsigned DEFAULT NULL,
  `SPINS` int(10) unsigned DEFAULT NULL,
  `OBJECT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_NAME` varchar(512) DEFAULT NULL,
  `INDEX_NAME` varchar(64) DEFAULT NULL,
  `OBJECT_TYPE` varchar(64) DEFAULT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned NOT NULL,
  `NESTING_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_TYPE` enum('STATEMENT','STAGE','WAIT') DEFAULT NULL,
  `OPERATION` varchar(32) NOT NULL,
  `NUMBER_OF_BYTES` bigint(20) DEFAULT NULL,
  `FLAGS` int(10) unsigned DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_waits_history`
--

LOCK TABLES `events_waits_history` WRITE;
/*!40000 ALTER TABLE `events_waits_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_waits_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_waits_history_long`
--

DROP TABLE IF EXISTS `events_waits_history_long`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_waits_history_long` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_ID` bigint(20) unsigned NOT NULL,
  `END_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `SOURCE` varchar(64) DEFAULT NULL,
  `TIMER_START` bigint(20) unsigned DEFAULT NULL,
  `TIMER_END` bigint(20) unsigned DEFAULT NULL,
  `TIMER_WAIT` bigint(20) unsigned DEFAULT NULL,
  `SPINS` int(10) unsigned DEFAULT NULL,
  `OBJECT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_NAME` varchar(512) DEFAULT NULL,
  `INDEX_NAME` varchar(64) DEFAULT NULL,
  `OBJECT_TYPE` varchar(64) DEFAULT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned NOT NULL,
  `NESTING_EVENT_ID` bigint(20) unsigned DEFAULT NULL,
  `NESTING_EVENT_TYPE` enum('STATEMENT','STAGE','WAIT') DEFAULT NULL,
  `OPERATION` varchar(32) NOT NULL,
  `NUMBER_OF_BYTES` bigint(20) DEFAULT NULL,
  `FLAGS` int(10) unsigned DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_waits_history_long`
--

LOCK TABLES `events_waits_history_long` WRITE;
/*!40000 ALTER TABLE `events_waits_history_long` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_waits_history_long` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_waits_summary_by_account_by_event_name`
--

DROP TABLE IF EXISTS `events_waits_summary_by_account_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_waits_summary_by_account_by_event_name` (
  `USER` char(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `HOST` char(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_waits_summary_by_account_by_event_name`
--

LOCK TABLES `events_waits_summary_by_account_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_waits_summary_by_account_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_waits_summary_by_account_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_waits_summary_by_host_by_event_name`
--

DROP TABLE IF EXISTS `events_waits_summary_by_host_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_waits_summary_by_host_by_event_name` (
  `HOST` char(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_waits_summary_by_host_by_event_name`
--

LOCK TABLES `events_waits_summary_by_host_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_waits_summary_by_host_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_waits_summary_by_host_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_waits_summary_by_instance`
--

DROP TABLE IF EXISTS `events_waits_summary_by_instance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_waits_summary_by_instance` (
  `EVENT_NAME` varchar(128) NOT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_waits_summary_by_instance`
--

LOCK TABLES `events_waits_summary_by_instance` WRITE;
/*!40000 ALTER TABLE `events_waits_summary_by_instance` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_waits_summary_by_instance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_waits_summary_by_thread_by_event_name`
--

DROP TABLE IF EXISTS `events_waits_summary_by_thread_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_waits_summary_by_thread_by_event_name` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_waits_summary_by_thread_by_event_name`
--

LOCK TABLES `events_waits_summary_by_thread_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_waits_summary_by_thread_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_waits_summary_by_thread_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_waits_summary_by_user_by_event_name`
--

DROP TABLE IF EXISTS `events_waits_summary_by_user_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_waits_summary_by_user_by_event_name` (
  `USER` char(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_waits_summary_by_user_by_event_name`
--

LOCK TABLES `events_waits_summary_by_user_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_waits_summary_by_user_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_waits_summary_by_user_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_waits_summary_global_by_event_name`
--

DROP TABLE IF EXISTS `events_waits_summary_global_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_waits_summary_global_by_event_name` (
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_waits_summary_global_by_event_name`
--

LOCK TABLES `events_waits_summary_global_by_event_name` WRITE;
/*!40000 ALTER TABLE `events_waits_summary_global_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_waits_summary_global_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_instances`
--

DROP TABLE IF EXISTS `file_instances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_instances` (
  `FILE_NAME` varchar(512) NOT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `OPEN_COUNT` int(10) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_instances`
--

LOCK TABLES `file_instances` WRITE;
/*!40000 ALTER TABLE `file_instances` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_instances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_summary_by_event_name`
--

DROP TABLE IF EXISTS `file_summary_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_summary_by_event_name` (
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `COUNT_READ` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ` bigint(20) unsigned NOT NULL,
  `SUM_NUMBER_OF_BYTES_READ` bigint(20) NOT NULL,
  `COUNT_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_NUMBER_OF_BYTES_WRITE` bigint(20) NOT NULL,
  `COUNT_MISC` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_MISC` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_summary_by_event_name`
--

LOCK TABLES `file_summary_by_event_name` WRITE;
/*!40000 ALTER TABLE `file_summary_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_summary_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_summary_by_instance`
--

DROP TABLE IF EXISTS `file_summary_by_instance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_summary_by_instance` (
  `FILE_NAME` varchar(512) NOT NULL,
  `EVENT_NAME` varchar(128) NOT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `COUNT_READ` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ` bigint(20) unsigned NOT NULL,
  `SUM_NUMBER_OF_BYTES_READ` bigint(20) NOT NULL,
  `COUNT_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_NUMBER_OF_BYTES_WRITE` bigint(20) NOT NULL,
  `COUNT_MISC` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_MISC` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_summary_by_instance`
--

LOCK TABLES `file_summary_by_instance` WRITE;
/*!40000 ALTER TABLE `file_summary_by_instance` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_summary_by_instance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `host_cache`
--

DROP TABLE IF EXISTS `host_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `host_cache` (
  `IP` varchar(64) NOT NULL,
  `HOST` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `HOST_VALIDATED` enum('YES','NO') NOT NULL,
  `SUM_CONNECT_ERRORS` bigint(20) NOT NULL,
  `COUNT_HOST_BLOCKED_ERRORS` bigint(20) NOT NULL,
  `COUNT_NAMEINFO_TRANSIENT_ERRORS` bigint(20) NOT NULL,
  `COUNT_NAMEINFO_PERMANENT_ERRORS` bigint(20) NOT NULL,
  `COUNT_FORMAT_ERRORS` bigint(20) NOT NULL,
  `COUNT_ADDRINFO_TRANSIENT_ERRORS` bigint(20) NOT NULL,
  `COUNT_ADDRINFO_PERMANENT_ERRORS` bigint(20) NOT NULL,
  `COUNT_FCRDNS_ERRORS` bigint(20) NOT NULL,
  `COUNT_HOST_ACL_ERRORS` bigint(20) NOT NULL,
  `COUNT_NO_AUTH_PLUGIN_ERRORS` bigint(20) NOT NULL,
  `COUNT_AUTH_PLUGIN_ERRORS` bigint(20) NOT NULL,
  `COUNT_HANDSHAKE_ERRORS` bigint(20) NOT NULL,
  `COUNT_PROXY_USER_ERRORS` bigint(20) NOT NULL,
  `COUNT_PROXY_USER_ACL_ERRORS` bigint(20) NOT NULL,
  `COUNT_AUTHENTICATION_ERRORS` bigint(20) NOT NULL,
  `COUNT_SSL_ERRORS` bigint(20) NOT NULL,
  `COUNT_MAX_USER_CONNECTIONS_ERRORS` bigint(20) NOT NULL,
  `COUNT_MAX_USER_CONNECTIONS_PER_HOUR_ERRORS` bigint(20) NOT NULL,
  `COUNT_DEFAULT_DATABASE_ERRORS` bigint(20) NOT NULL,
  `COUNT_INIT_CONNECT_ERRORS` bigint(20) NOT NULL,
  `COUNT_LOCAL_ERRORS` bigint(20) NOT NULL,
  `COUNT_UNKNOWN_ERRORS` bigint(20) NOT NULL,
  `FIRST_SEEN` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LAST_SEEN` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FIRST_ERROR_SEEN` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `LAST_ERROR_SEEN` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `host_cache`
--

LOCK TABLES `host_cache` WRITE;
/*!40000 ALTER TABLE `host_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `host_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hosts`
--

DROP TABLE IF EXISTS `hosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hosts` (
  `HOST` char(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `CURRENT_CONNECTIONS` bigint(20) NOT NULL,
  `TOTAL_CONNECTIONS` bigint(20) NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hosts`
--

LOCK TABLES `hosts` WRITE;
/*!40000 ALTER TABLE `hosts` DISABLE KEYS */;
/*!40000 ALTER TABLE `hosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mutex_instances`
--

DROP TABLE IF EXISTS `mutex_instances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mutex_instances` (
  `NAME` varchar(128) NOT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned NOT NULL,
  `LOCKED_BY_THREAD_ID` bigint(20) unsigned DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mutex_instances`
--

LOCK TABLES `mutex_instances` WRITE;
/*!40000 ALTER TABLE `mutex_instances` DISABLE KEYS */;
/*!40000 ALTER TABLE `mutex_instances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objects_summary_global_by_type`
--

DROP TABLE IF EXISTS `objects_summary_global_by_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objects_summary_global_by_type` (
  `OBJECT_TYPE` varchar(64) DEFAULT NULL,
  `OBJECT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_NAME` varchar(64) DEFAULT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objects_summary_global_by_type`
--

LOCK TABLES `objects_summary_global_by_type` WRITE;
/*!40000 ALTER TABLE `objects_summary_global_by_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `objects_summary_global_by_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `performance_timers`
--

DROP TABLE IF EXISTS `performance_timers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `performance_timers` (
  `TIMER_NAME` enum('CYCLE','NANOSECOND','MICROSECOND','MILLISECOND','TICK') NOT NULL,
  `TIMER_FREQUENCY` bigint(20) DEFAULT NULL,
  `TIMER_RESOLUTION` bigint(20) DEFAULT NULL,
  `TIMER_OVERHEAD` bigint(20) DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `performance_timers`
--

LOCK TABLES `performance_timers` WRITE;
/*!40000 ALTER TABLE `performance_timers` DISABLE KEYS */;
/*!40000 ALTER TABLE `performance_timers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rwlock_instances`
--

DROP TABLE IF EXISTS `rwlock_instances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rwlock_instances` (
  `NAME` varchar(128) NOT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned NOT NULL,
  `WRITE_LOCKED_BY_THREAD_ID` bigint(20) unsigned DEFAULT NULL,
  `READ_LOCKED_BY_COUNT` int(10) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rwlock_instances`
--

LOCK TABLES `rwlock_instances` WRITE;
/*!40000 ALTER TABLE `rwlock_instances` DISABLE KEYS */;
/*!40000 ALTER TABLE `rwlock_instances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_account_connect_attrs`
--

DROP TABLE IF EXISTS `session_account_connect_attrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_account_connect_attrs` (
  `PROCESSLIST_ID` int(11) NOT NULL,
  `ATTR_NAME` varchar(32) COLLATE utf8_bin NOT NULL,
  `ATTR_VALUE` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `ORDINAL_POSITION` int(11) DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_account_connect_attrs`
--

LOCK TABLES `session_account_connect_attrs` WRITE;
/*!40000 ALTER TABLE `session_account_connect_attrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `session_account_connect_attrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_connect_attrs`
--

DROP TABLE IF EXISTS `session_connect_attrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_connect_attrs` (
  `PROCESSLIST_ID` int(11) NOT NULL,
  `ATTR_NAME` varchar(32) COLLATE utf8_bin NOT NULL,
  `ATTR_VALUE` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `ORDINAL_POSITION` int(11) DEFAULT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_connect_attrs`
--

LOCK TABLES `session_connect_attrs` WRITE;
/*!40000 ALTER TABLE `session_connect_attrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `session_connect_attrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_actors`
--

DROP TABLE IF EXISTS `setup_actors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setup_actors` (
  `HOST` char(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '%',
  `USER` char(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '%',
  `ROLE` char(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '%'
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_actors`
--

LOCK TABLES `setup_actors` WRITE;
/*!40000 ALTER TABLE `setup_actors` DISABLE KEYS */;
/*!40000 ALTER TABLE `setup_actors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_consumers`
--

DROP TABLE IF EXISTS `setup_consumers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setup_consumers` (
  `NAME` varchar(64) NOT NULL,
  `ENABLED` enum('YES','NO') NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_consumers`
--

LOCK TABLES `setup_consumers` WRITE;
/*!40000 ALTER TABLE `setup_consumers` DISABLE KEYS */;
/*!40000 ALTER TABLE `setup_consumers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_instruments`
--

DROP TABLE IF EXISTS `setup_instruments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setup_instruments` (
  `NAME` varchar(128) NOT NULL,
  `ENABLED` enum('YES','NO') NOT NULL,
  `TIMED` enum('YES','NO') NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_instruments`
--

LOCK TABLES `setup_instruments` WRITE;
/*!40000 ALTER TABLE `setup_instruments` DISABLE KEYS */;
/*!40000 ALTER TABLE `setup_instruments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_objects`
--

DROP TABLE IF EXISTS `setup_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setup_objects` (
  `OBJECT_TYPE` enum('TABLE') NOT NULL DEFAULT 'TABLE',
  `OBJECT_SCHEMA` varchar(64) DEFAULT '%',
  `OBJECT_NAME` varchar(64) NOT NULL DEFAULT '%',
  `ENABLED` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `TIMED` enum('YES','NO') NOT NULL DEFAULT 'YES'
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_objects`
--

LOCK TABLES `setup_objects` WRITE;
/*!40000 ALTER TABLE `setup_objects` DISABLE KEYS */;
/*!40000 ALTER TABLE `setup_objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setup_timers`
--

DROP TABLE IF EXISTS `setup_timers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setup_timers` (
  `NAME` varchar(64) NOT NULL,
  `TIMER_NAME` enum('CYCLE','NANOSECOND','MICROSECOND','MILLISECOND','TICK') NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setup_timers`
--

LOCK TABLES `setup_timers` WRITE;
/*!40000 ALTER TABLE `setup_timers` DISABLE KEYS */;
/*!40000 ALTER TABLE `setup_timers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_instances`
--

DROP TABLE IF EXISTS `socket_instances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socket_instances` (
  `EVENT_NAME` varchar(128) NOT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned NOT NULL,
  `THREAD_ID` bigint(20) unsigned DEFAULT NULL,
  `SOCKET_ID` int(11) NOT NULL,
  `IP` varchar(64) NOT NULL,
  `PORT` int(11) NOT NULL,
  `STATE` enum('IDLE','ACTIVE') NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socket_instances`
--

LOCK TABLES `socket_instances` WRITE;
/*!40000 ALTER TABLE `socket_instances` DISABLE KEYS */;
/*!40000 ALTER TABLE `socket_instances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_summary_by_event_name`
--

DROP TABLE IF EXISTS `socket_summary_by_event_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socket_summary_by_event_name` (
  `EVENT_NAME` varchar(128) NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `COUNT_READ` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ` bigint(20) unsigned NOT NULL,
  `SUM_NUMBER_OF_BYTES_READ` bigint(20) unsigned NOT NULL,
  `COUNT_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_NUMBER_OF_BYTES_WRITE` bigint(20) unsigned NOT NULL,
  `COUNT_MISC` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_MISC` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socket_summary_by_event_name`
--

LOCK TABLES `socket_summary_by_event_name` WRITE;
/*!40000 ALTER TABLE `socket_summary_by_event_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `socket_summary_by_event_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_summary_by_instance`
--

DROP TABLE IF EXISTS `socket_summary_by_instance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socket_summary_by_instance` (
  `EVENT_NAME` varchar(128) NOT NULL,
  `OBJECT_INSTANCE_BEGIN` bigint(20) unsigned NOT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `COUNT_READ` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ` bigint(20) unsigned NOT NULL,
  `SUM_NUMBER_OF_BYTES_READ` bigint(20) unsigned NOT NULL,
  `COUNT_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_NUMBER_OF_BYTES_WRITE` bigint(20) unsigned NOT NULL,
  `COUNT_MISC` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_MISC` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_MISC` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socket_summary_by_instance`
--

LOCK TABLES `socket_summary_by_instance` WRITE;
/*!40000 ALTER TABLE `socket_summary_by_instance` DISABLE KEYS */;
/*!40000 ALTER TABLE `socket_summary_by_instance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_io_waits_summary_by_index_usage`
--

DROP TABLE IF EXISTS `table_io_waits_summary_by_index_usage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_io_waits_summary_by_index_usage` (
  `OBJECT_TYPE` varchar(64) DEFAULT NULL,
  `OBJECT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_NAME` varchar(64) DEFAULT NULL,
  `INDEX_NAME` varchar(64) DEFAULT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `COUNT_READ` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ` bigint(20) unsigned NOT NULL,
  `COUNT_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `COUNT_FETCH` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_FETCH` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_FETCH` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_FETCH` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_FETCH` bigint(20) unsigned NOT NULL,
  `COUNT_INSERT` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_INSERT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_INSERT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_INSERT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_INSERT` bigint(20) unsigned NOT NULL,
  `COUNT_UPDATE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_UPDATE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_UPDATE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_UPDATE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_UPDATE` bigint(20) unsigned NOT NULL,
  `COUNT_DELETE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_DELETE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_DELETE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_DELETE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_DELETE` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_io_waits_summary_by_index_usage`
--

LOCK TABLES `table_io_waits_summary_by_index_usage` WRITE;
/*!40000 ALTER TABLE `table_io_waits_summary_by_index_usage` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_io_waits_summary_by_index_usage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_io_waits_summary_by_table`
--

DROP TABLE IF EXISTS `table_io_waits_summary_by_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_io_waits_summary_by_table` (
  `OBJECT_TYPE` varchar(64) DEFAULT NULL,
  `OBJECT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_NAME` varchar(64) DEFAULT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `COUNT_READ` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ` bigint(20) unsigned NOT NULL,
  `COUNT_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `COUNT_FETCH` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_FETCH` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_FETCH` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_FETCH` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_FETCH` bigint(20) unsigned NOT NULL,
  `COUNT_INSERT` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_INSERT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_INSERT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_INSERT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_INSERT` bigint(20) unsigned NOT NULL,
  `COUNT_UPDATE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_UPDATE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_UPDATE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_UPDATE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_UPDATE` bigint(20) unsigned NOT NULL,
  `COUNT_DELETE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_DELETE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_DELETE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_DELETE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_DELETE` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_io_waits_summary_by_table`
--

LOCK TABLES `table_io_waits_summary_by_table` WRITE;
/*!40000 ALTER TABLE `table_io_waits_summary_by_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_io_waits_summary_by_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_lock_waits_summary_by_table`
--

DROP TABLE IF EXISTS `table_lock_waits_summary_by_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_lock_waits_summary_by_table` (
  `OBJECT_TYPE` varchar(64) DEFAULT NULL,
  `OBJECT_SCHEMA` varchar(64) DEFAULT NULL,
  `OBJECT_NAME` varchar(64) DEFAULT NULL,
  `COUNT_STAR` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WAIT` bigint(20) unsigned NOT NULL,
  `COUNT_READ` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ` bigint(20) unsigned NOT NULL,
  `COUNT_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE` bigint(20) unsigned NOT NULL,
  `COUNT_READ_NORMAL` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ_NORMAL` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ_NORMAL` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ_NORMAL` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ_NORMAL` bigint(20) unsigned NOT NULL,
  `COUNT_READ_WITH_SHARED_LOCKS` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ_WITH_SHARED_LOCKS` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ_WITH_SHARED_LOCKS` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ_WITH_SHARED_LOCKS` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ_WITH_SHARED_LOCKS` bigint(20) unsigned NOT NULL,
  `COUNT_READ_HIGH_PRIORITY` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ_HIGH_PRIORITY` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ_HIGH_PRIORITY` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ_HIGH_PRIORITY` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ_HIGH_PRIORITY` bigint(20) unsigned NOT NULL,
  `COUNT_READ_NO_INSERT` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ_NO_INSERT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ_NO_INSERT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ_NO_INSERT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ_NO_INSERT` bigint(20) unsigned NOT NULL,
  `COUNT_READ_EXTERNAL` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_READ_EXTERNAL` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_READ_EXTERNAL` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_READ_EXTERNAL` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_READ_EXTERNAL` bigint(20) unsigned NOT NULL,
  `COUNT_WRITE_ALLOW_WRITE` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE_ALLOW_WRITE` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE_ALLOW_WRITE` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE_ALLOW_WRITE` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE_ALLOW_WRITE` bigint(20) unsigned NOT NULL,
  `COUNT_WRITE_CONCURRENT_INSERT` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE_CONCURRENT_INSERT` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE_CONCURRENT_INSERT` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE_CONCURRENT_INSERT` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE_CONCURRENT_INSERT` bigint(20) unsigned NOT NULL,
  `COUNT_WRITE_DELAYED` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE_DELAYED` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE_DELAYED` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE_DELAYED` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE_DELAYED` bigint(20) unsigned NOT NULL,
  `COUNT_WRITE_LOW_PRIORITY` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE_LOW_PRIORITY` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE_LOW_PRIORITY` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE_LOW_PRIORITY` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE_LOW_PRIORITY` bigint(20) unsigned NOT NULL,
  `COUNT_WRITE_NORMAL` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE_NORMAL` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE_NORMAL` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE_NORMAL` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE_NORMAL` bigint(20) unsigned NOT NULL,
  `COUNT_WRITE_EXTERNAL` bigint(20) unsigned NOT NULL,
  `SUM_TIMER_WRITE_EXTERNAL` bigint(20) unsigned NOT NULL,
  `MIN_TIMER_WRITE_EXTERNAL` bigint(20) unsigned NOT NULL,
  `AVG_TIMER_WRITE_EXTERNAL` bigint(20) unsigned NOT NULL,
  `MAX_TIMER_WRITE_EXTERNAL` bigint(20) unsigned NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_lock_waits_summary_by_table`
--

LOCK TABLES `table_lock_waits_summary_by_table` WRITE;
/*!40000 ALTER TABLE `table_lock_waits_summary_by_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_lock_waits_summary_by_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `threads` (
  `THREAD_ID` bigint(20) unsigned NOT NULL,
  `NAME` varchar(128) NOT NULL,
  `TYPE` varchar(10) NOT NULL,
  `PROCESSLIST_ID` bigint(20) unsigned DEFAULT NULL,
  `PROCESSLIST_USER` varchar(128) DEFAULT NULL,
  `PROCESSLIST_HOST` varchar(60) DEFAULT NULL,
  `PROCESSLIST_DB` varchar(64) DEFAULT NULL,
  `PROCESSLIST_COMMAND` varchar(16) DEFAULT NULL,
  `PROCESSLIST_TIME` bigint(20) DEFAULT NULL,
  `PROCESSLIST_STATE` varchar(64) DEFAULT NULL,
  `PROCESSLIST_INFO` longtext DEFAULT NULL,
  `PARENT_THREAD_ID` bigint(20) unsigned DEFAULT NULL,
  `ROLE` varchar(64) DEFAULT NULL,
  `INSTRUMENTED` enum('YES','NO') NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `USER` char(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `CURRENT_CONNECTIONS` bigint(20) NOT NULL,
  `TOTAL_CONNECTIONS` bigint(20) NOT NULL
) ENGINE=PERFORMANCE_SCHEMA DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-01 12:00:03
