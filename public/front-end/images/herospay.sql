
-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_verified` int NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `is_admin` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `status` tinyint NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `plan_id` int DEFAULT NULL,
  `invested_amount` decimal(19,5) NOT NULL,
  `remaining_payout` decimal(19,5) NOT NULL,
  `income_amount` decimal(19,5) NOT NULL,
  `request_id` varchar(30) NOT NULL,
  `is_first` tinyint NOT NULL,
  `is_activation` tinyint NOT NULL,
  `currency` enum('naira','btc') NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `withdrawal_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `referrer_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_bonus`
--

CREATE TABLE `referral_bonus` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `referrer_id` int NOT NULL,
  `investment_id` int NOT NULL,
  `bonus` decimal(19,5) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_coupons`
--

CREATE TABLE `registration_coupons` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `used_by` varchar(30) DEFAULT NULL,
  `used_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Registration coupon code';

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(255) NOT NULL,
  `type` varchar(15) NOT NULL DEFAULT 'text',
  `options` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `pin` varchar(13) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonies`
--

CREATE TABLE `testimonies` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `testimony` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `investment_id` int NOT NULL,
  `user_investment_id` int NOT NULL,
  `withdrawal_id` int NOT NULL,
  `user_withdrawal_id` int NOT NULL,
  `amount` decimal(19,5) NOT NULL,
  `currency` enum('naira','btc') NOT NULL,
  `status` int NOT NULL COMMENT '0 = cancelled\n1 = active\n2 = payment confirmed\n3 = reported',
  `prove_of_payment` varchar(255) NOT NULL,
  `grace_period` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_reports`
--

CREATE TABLE `transaction_reports` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `transaction_id` int NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `admin_id` int DEFAULT NULL COMMENT 'Admin to handle the Reported Transaction',
  `status` int NOT NULL DEFAULT '1' COMMENT '1 = active, 2 = resolved',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `reported_user_id` int NOT NULL COMMENT 'the reported user id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='all transactions with a report';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `news_letter_subscription` tinyint DEFAULT NULL,
  `verification_token` varchar(30) NOT NULL,
  `email_verified` tinyint NOT NULL,
  `phone_verified` tinyint NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0 = Suspended\n1 = Active\n',
  `is_activated` tinyint NOT NULL,
  `activated_at` datetime DEFAULT NULL,
  `level` tinyint NOT NULL DEFAULT '1' COMMENT '1 = Regular\n2 = Guider\n3 = Admin',
  `penalty` varchar(20) NOT NULL,
  `referral_id` varchar(15) NOT NULL,
  `last_invested_amount_in_naira` decimal(19,5) NOT NULL DEFAULT '0.00000',
  `last_invested_amount_in_btc` decimal(19,5) NOT NULL DEFAULT '0.00000',
  `remaining_bonus_in_naira` decimal(19,5) NOT NULL DEFAULT '0.00000',
  `remaining_bonus_in_btc` decimal(19,5) NOT NULL DEFAULT '0.00000',
  `account_name` varchar(30) NOT NULL,
  `account_number` varchar(10) DEFAULT NULL,
  `bank_id` int NOT NULL,
  `btc_address` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_reports`
--

CREATE TABLE `user_reports` (
  `id` int NOT NULL,
  `transaction_id` int NOT NULL COMMENT 'the reported transaction id',
  `user_id` int NOT NULL COMMENT 'reported user id',
  `user_username` varchar(30) NOT NULL COMMENT 'reported user username',
  `comment` varchar(255) DEFAULT NULL COMMENT 'comment for the report',
  `admin_id` int NOT NULL COMMENT 'admin that reported',
  `admin_username` varchar(30) NOT NULL COMMENT 'admin username',
  `status` int NOT NULL DEFAULT '1' COMMENT '1 = active, 2 = resolved',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='All Reports from admin to Super Admin';

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `investment_id` int DEFAULT NULL,
  `amount` decimal(19,5) NOT NULL,
  `remaining_income` decimal(19,5) NOT NULL,
  `currency` enum('naira','btc') NOT NULL,
  `request_id` varchar(30) NOT NULL,
  `status` tinyint NOT NULL COMMENT '0 = pused, 1 = active, 2 = fully merged, 3 = completed, 4 =confirmed',
  `priority` int NOT NULL DEFAULT '1',
  `is_activation` int DEFAULT '0' COMMENT 'To identify admin activation withdrawals',
  `created_by` varchar(30) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `request_id` (`request_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `referral_bonus`
--
ALTER TABLE `referral_bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_coupons`
--
ALTER TABLE `registration_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `pin` (`pin`);

--
-- Indexes for table `testimonies`
--
ALTER TABLE `testimonies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_reports`
--
ALTER TABLE `transaction_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `users_username_uindex` (`username`),
  ADD UNIQUE KEY `account_number` (`account_number`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `user_reports`
--
ALTER TABLE `user_reports`
  ADD UNIQUE KEY `admin_reports_id_uindex` (`id`),
  ADD UNIQUE KEY `admin_reports_transaction_id_uindex` (`transaction_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `request_id` (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referral_bonus`
--
ALTER TABLE `referral_bonus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `registration_coupons`
--
ALTER TABLE `registration_coupons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `testimonies`
--
ALTER TABLE `testimonies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction_reports`
--
ALTER TABLE `transaction_reports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_reports`
--
ALTER TABLE `user_reports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
